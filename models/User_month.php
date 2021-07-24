<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use DateTimeZone;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class User_month extends DbModel
{
    public ?DateTime $createdAt;
    /** @var user[] $labels */
    public array $users = [];

    public function __construct()
    {
        parent::__construct();
        $now = new DateTime('', new DateTimeZone('GMT'));
        $mothRanking = new DateTime($now->format('y') . '-' . $now->format('m') . '-01', new DateTimeZone('GMT'));
        $this->createdAt = $mothRanking;
        $this->users = [];
    }


    public static function collectionName(): string
    {
        return 'USER_MONTHS';
    }
    public static function updateUser(User_month $user_month, User $user, string $fieldename)
    {
        $collection = $this->getCollection();
        $result = $collection->findOne([
            '_id' => $user_month->getId(),
            'users._id' => $user->getId()
        ]);
        if ($result != null) {
            $collection->updateOne(
                [
                    '_id' => $user_month->getId(),
                    'users._id' => $user->getId()
                ],
                ['$inc' => ['users.$.' . $fieldename => 1]]
            );
        } else {
            $this->addUser($user_month, $user, $fieldename);
        }
    }
    public static function addUser(User_month $user_month, User $user, string $fieldename)
    {
        $collection = $this->getCollection();
        $newUser = array(
            '_id' => $user->getId(),
            'name' => $user->name,
            'totalAnswers' => $fieldename == 'totalAnswers' ? 1 : 0,
            'totalQuestions' => $fieldename == 'totalQuestions' ? 1 : 0,
            'score' => $fieldename == 'score' ? 1 : 0
        );
        $collection->updateOne(['_id' => $user_month->getId()], ['$push' => ['users' => $newUser]]);
    }
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'createdAt' => new UTCDateTime($this->createdAt->getTimestamp() * 1000),
            'users' => array_map(fn ($item) => [
                '_id' => $item->getId(),
                'name' => $item->name,
                'totalPostedQuestion' => $item->totalQuestions,
                'totalPostedAnswser' => $item->totalAnswers,
                'score' => $item->score,
            ], $this->users),
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->createdAt = $data['createdAt']->toDateTime();
        foreach ($data['users'] as $user) {
            $this->users[] = User::findOne(['_id' => $user->_id]);
        }
    }
}
