<?php


namespace app\models;


use app\core\db\DbModel;
use Exception;
use MongoDB\BSON\ObjectId;

class User extends DbModel
{
    public string $username;
    public string $fullName;
    public string $email;
    public string $password;
    public \DateTime $joinDate;
    public string $imgPath = '';
    public bool $isAdmin = false;

    /**
     * User constructor.
     * @param string $fullName
     * @param string $email
     * @param string $password
     * @param string $username
     * @throws Exception
     */
    public function __construct(string $fullName = '', string $email = '', string $password = '', string $username = '')
    {
        $this->email = $email;
        $this->password = $password;
        $this->fullName = $fullName;
        $this->username = $username;
        $this->joinDate = new \DateTime('now', new \DateTimeZone('Asia/Ho_Chi_Minh'));
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
                case '_id': {
                    $user->_id = new ObjectId($value);
                    break;
                }
                case 'joinDate': {
                    $user->joinDate = new \DateTime($value['date'], new \DateTimeZone($value['timezone']));
                    break;
                }
                default: {
                    $user->$attr = $value;
                    break;
                }
            }
        }
        return $user;
    }
}