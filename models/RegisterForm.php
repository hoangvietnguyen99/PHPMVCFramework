<?php


namespace app\models;


use app\core\Model;

class RegisterForm extends Model
{
    public string $fullName = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function labels(): array
    {
        return [
            'fullName' => 'Full name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password Confirm'
        ];
    }

    public function rules(): array
    {
        return [
            'fullName' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED, [
                self::RULE_UNIQUE, 'class' => User::class
            ]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => User::class
            ]],
            'password' => [self::RULE_REQUIRED,
                [
                    self::RULE_MATCH_REGEX,
                    'regex' => '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/',
                    'message' => 'Your password must be more than 8 characters long, at least one upper case letter, at least one lower case letter, and at least one number or special character.'
                ]
            ],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function register(): bool
    {
        $user = new User($this->fullName, $this->email, password_hash($this->password, PASSWORD_DEFAULT), $this->username);
        if ($user->insertOrUpdateOne()) {
            return true;
        }
        return false;
    }
}