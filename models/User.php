<?php


namespace app\models;


use app\constants\Gender;
use app\core\Application;
use app\core\db\DbModel;
use MongoDB\BSON\UTCDateTime;

class User extends DbModel
{
    public string $username = '';
    public string $firstName = '';
    public string $middleName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public UTCDateTime $joinDate;
    public UTCDateTime $dateOfBirth;
    public string $imgPath = '';
    public string $gender = Gender::MALE;
    public bool $isAdmin = false;

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

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->middleName . ' ' . $this->lastName;
    }

    public function getShortLetterName()
    {
        return $this->firstName[0] . $this->lastName[0];
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'joinDate' => $this->joinDate,
            'dateOfBirth' => $this->dateOfBirth,
            'imgPath' => $this->imgPath,
            'gender' => $this->gender,
            'isAdmin' => $this->isAdmin,
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->username = $data['username'];
        $this->firstName = $data['firstName'];
        $this->middleName = $data['middleName'];
        $this->lastName = $data['lastName'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->joinDate = $data['joinDate'];
        $this->dateOfBirth = $data['dateOfBirth'];
        $this->imgPath = $data['imgPath'];
        $this->gender = $data['gender'];
        $this->isAdmin = $data['isAdmin'];
    }
}