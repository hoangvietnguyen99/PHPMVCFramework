<?php


namespace app\models;


use app\constants\Gender;
use app\constants\Role;
use app\constants\Tier;
use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\UTCDateTime;

class User extends DbModel
{
    public string $name = '';
    public string $role = Role::USER;
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public DateTime $joinDate;
    public DateTime $dateOfBirth;
    public string $imgPath = '';
    public string $gender = Gender::MALE;
    public int $totalQuestions = 0;
    public int $totalAnswers = 0;
    public int $totalLikes = 0;
    public int $totalDislikes = 0;
    public string $tier = Tier::BASIC;
    public int $score = 0;
    public float $averageRate = 0;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->joinDate = new DateTime();
    }

    public static function collectionName(): string
    {
        return 'USERS';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'role' => $this->role,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password,
            'joinDate' => new UTCDateTime($this->joinDate->getTimestamp() * 1000),
            'dateOfBirth' => new UTCDateTime($this->dateOfBirth->getTimestamp() * 1000),
            'imgPath' => $this->imgPath,
            'gender' => $this->gender,
            'totalPostedQuestion' => $this->totalQuestions,
            'totalPostedAnswser' => $this->totalAnswers,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
            'tier' => $this->tier,
            'score' => $this->score,
            'averageRate' => ($this->totalLikes - $this->totalDislikes) / (($this->totalQuestions + $this->totalAnswers) || 1),
        ];
    }

    public function bsonUnserialize(array $data)
    {
        if (isset($data['_id'])) $this->_id = $data['_id'];
        if (isset($data['name'])) $this->name = $data['name'];
        if (isset($data['role'])) $this->role = $data['role'];
        if (isset($data['phone'])) $this->phone = $data['phone'];
        if (isset($data['email'])) $this->email = $data['email'];
        if (isset($data['password'])) $this->password = $data['password'];
        if (isset($data['joinDate'])) $this->joinDate = $data['joinDate']->toDateTime();
        if (isset($data['dateOfBirth'])) $this->dateOfBirth = $data['dateOfBirth']->toDateTime();
        if (isset($data['imgPath'])) $this->imgPath = $data['imgPath'];
        if (isset($data['gender'])) $this->gender = $data['gender'];
        if (isset($data['totalPostedQuestion'])) $this->totalQuestions = $data['totalPostedQuestion'];
        if (isset($data['totalPostedAnswser'])) $this->totalAnswers = $data['totalPostedAnswser'];
        if (isset($data['totalLikes'])) $this->totalLikes = $data['totalLikes'];
        if (isset($data['totalDislikes'])) $this->totalDislikes = $data['totalDislikes'];
        if (isset($data['tier'])) $this->tier = $data['tier'];
        if (isset($data['score'])) $this->score = $data['score'];
        if (isset($data['averageRate'])) $this->averageRate = $data['averageRate'];
    }
}