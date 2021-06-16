<?php


namespace app\models;


use app\core\DbModel;

class User extends DbModel
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;

    /**
     * User constructor.
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $password
     */
    public function __construct(string $firstname = '', string $lastname = '', string $email = '', string $password = '')
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
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
        return ['firstname', 'lastname', 'email', 'password'];
    }

    public function rules(): array
    {
        return [
            'email' => [
                [self::RULE_UNIQUE, 'class' => self::class]
            ]
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}