<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use Exception;
use MongoDB\BSON\ObjectId;

class User extends DbModel
{
    public string $username = '';
    public string $firstName = '';
    public string $middleName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public DateTime $joinDate;
    public DateTime $dateOfBirth;
    public string $imgPath = '';
    public string $gender = 'Male';
    public bool $isAdmin = false;

    /**
     * User constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->dateOfBirth = new DateTime('now', new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $this->joinDate = new DateTime('now', new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $this->_id = new ObjectId();
    }


    public static function collectionName(): string
    {
        return 'users';
    }

    /**
     * @throws Exception
     */
    public static function convertToClass(object|array $data): User
    {
        $user = new User();
        foreach ($data as $attr => $value) {
            switch ($attr) {
                case '_id':
                {
                    $user->_id = new ObjectId($value);
                    break;
                }
                case 'joinDate':
                {
                    $user->joinDate = new DateTime($value['date'], new \DateTimeZone($value['timezone']));
                    break;
                }
                case 'dateOfBirth':
                {
                    $user->dateOfBirth = new DateTime($value['date'], new \DateTimeZone($value['timezone']));
                    break;
                }
                default:
                {
                    $user->$attr = $value;
                    break;
                }
            }
        }
        return $user;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->middleName . ' ' . $this->lastName;
    }
}