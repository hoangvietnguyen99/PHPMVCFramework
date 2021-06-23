<?php


namespace app\models;


use app\constants\Gender;
use app\constants\Role;
use app\constants\Tier;
use app\core\db\DbModel;
use MongoDB\BSON\UTCDateTime;

class User extends DbModel
{
    public string $name = '';
    public string $role = Role::USER;
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public UTCDateTime $joinDate;
    public ?UTCDateTime $dateOfBirth = null;
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
        $this->joinDate = new UTCDateTime(strtotime('now') * 1000);
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
            'joinDate' => $this->joinDate,
            'dateOfBirth' => $this->dateOfBirth,
            'imgPath' => $this->imgPath,
            'gender' => $this->gender,
            'totalQuestions' => $this->totalQuestions,
            'totalAnswers' => $this->totalAnswers,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
            'tier' => $this->tier,
            'score' => $this->score,
            'averageRate' => ($this->totalLikes - $this->totalDislikes) / (($this->totalQuestions + $this->totalAnswers) ?? 1),
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->name = $data['name'];
        $this->role = $data['role'];
        $this->phone = $data['phone'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->joinDate = $data['joinDate'];
        $this->dateOfBirth = $data['dateOfBirth'];
        $this->imgPath = $data['imgPath'];
        $this->gender = $data['gender'];
        $this->totalQuestions = $data['totalQuestions'];
        $this->totalAnswers = $data['totalAnswers'];
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
        $this->tier = $data['tier'];
        $this->score = $data['score'];
        $this->averageRate = $data['averageRate'];
    }
}