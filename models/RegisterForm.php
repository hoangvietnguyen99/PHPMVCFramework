<?php


namespace app\models;


use app\core\Model;

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
            'gender' => [self::RULE_REQUIRED, [self::RULE_IN_ARRAY, 'values' => ['Male', 'Female']]],
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
                        $user->dateOfBirth = \DateTime::createFromFormat('m/d/Y', $value, new \DateTimeZone('Asia/Ho_Chi_Minh'));
                        break;
                    }
                    default: {
                        $user->$key = $value;
                        break;
                    }
                }
            }
        }
        if ($user->insertOrUpdateOne()) {
            return true;
        }
        return false;
    }
}