<?php


namespace app\models;


use app\constants\Gender;
use app\core\Model;
use MongoDB\BSON\UTCDateTime;

class RegisterForm extends Model
{
    public string $firstName;
    public string $middleName;
    public string $lastName;
    public string $username;
    public string $email;
    public string $gender;
    public string $password;
    public string $dateOfBirth;
    public string $passwordConfirm;

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'middleName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
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
                    'message' => 'Invalid password.'
                ]
            ],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'gender' => [self::RULE_REQUIRED, [self::RULE_IN_ARRAY, 'values' => [Gender::FEMALE, Gender::MALE]]],
            'dateOfBirth' => [self::RULE_REQUIRED],
        ];
    }

    public function register(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $user = new User();
        foreach ($this as $key => $value) {
            if (property_exists($user, $key)) {
                switch ($key) {
                    case 'dateOfBirth': {
                        $user->dateOfBirth = new UTCDateTime(strtotime($value) * 1000);
                        break;
                    }
                    default: {
                        $user->$key = $value;
                        break;
                    }
                }
            }
        }
        $userId = $user->insertOrUpdateOne();
        if ($userId) {
            return true;
        }
        return false;
    }

    public function labels(): array
    {
        return [
            'firstName' => 'First name',
            'middleName' => 'Middle name',
            'lastName' => 'Last name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password confirm',
            'gender' => 'Gender',
            'dateOfBirth' => 'Date of birth'
        ];
    }
}