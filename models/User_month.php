<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use DateTimeZone;
use app\constants\Score;
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
        $collection = self::getCollection();
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
                ['$inc' => ['users.$.' . $fieldename => 1, 'users.$.score' => ($fieldename == 'totalAnswers' ? 10 : 5)]]
            );
        } else {
            self::addUser($user_month, $user, $fieldename);
        }
    }
    public static function addUser(User_month $user_month, User $user, string $fieldename)
    {
        $collection = self::getCollection();
        $newUser = array(
            '_id' => $user->getId(),
            'name' => $user->name,
            'imgPath'=>$user->imgPath,
            'email'=>$user->email,
            'totalAnswers' => $fieldename == 'totalAnswers' ? 1 : 0,
            'totalQuestions' => $fieldename == 'totalQuestions' ? 1 : 0,
            'score' => $fieldename == 'totalAnswers' ? 10 : 5
        );
        $collection->updateOne(['_id' => $user_month->getId()], ['$push' => ['users' => $newUser]]);
    }
    public static function getTopUser($month)
    {
        $collection = self::getCollection();
        // $option = [
        //     'projection' => ['users' => 1],
        //     'sort' => ['users.score' => 1]
        // ];
        // return self::findOne(['createdAt' => new UTCDateTime($month->getTimestamp() * 1000)], $option);
        return ($collection->aggregate(
            [
                ['$match' => ['createdAt' => new UTCDateTime($month->getTimestamp() * 1000)]],
                ['$unwind' => '$users'],
                ['$project' => ['users' => 1]],
                ['$sort' => ['users.score' => -1]]
            ]
        ))->toArray();
    }
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'createdAt' => new UTCDateTime($this->createdAt->getTimestamp() * 1000),
            'users' => array_map(fn ($item) => [
                '_id' => $item->getId(),
                'name' => $item->name,
                'email' => $item->email,
                'imgPath' => $item->imgPath,
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
