<?php


namespace app\models;


use app\core\Model;

class RegisterForm extends Model
{
    public string $fullname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function labels(): array
    {
        return [
            'fullname' => 'Full name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password Confirm'
        ];
    }

    public function rules(): array
    {
        return [
            'fullname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
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

    public function register() {
        $user = new User($this->fullname, $this->email, password_hash($this->password, PASSWORD_DEFAULT));
        if ($user->validate()) {
            $user->insertOne();
            return true;
        }
        else {
            foreach ($user->errors as $attr => $message) {
                if ($message[0]) $this->addError($attr, $message[0]);
            }
            return false;
        }
    }
}