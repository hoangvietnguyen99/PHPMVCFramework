<?php


namespace app\models;


use app\core\db\DbModel;

class User extends DbModel
{
    public string $fullname;
    public string $email;
    public string $password;

    /**
     * User constructor.
     * @param string $fullname
     * @param string $email
     * @param string $password
     */
    public function __construct(string $fullname = '', string $email = '', string $password = '')
    {
        $this->email = $email;
        $this->password = $password;
        $this->fullname = $fullname;
    }

    public static function collectionName(): string
    {
        return 'users';
    }

    public function labels(): array
    {
        return [
            'email' => 'Email'
        ];
    }

    public function attributes(): array
    {
        return ['fullname', 'email', 'password'];
    }

    public function rules(): array
    {
        return [
            'email' => [
                [self::RULE_UNIQUE, 'class' => self::class]
            ]
        ];
    }
}