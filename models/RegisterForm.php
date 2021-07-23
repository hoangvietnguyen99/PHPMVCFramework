<?php


namespace app\models;


use app\constants\Gender;
use app\core\Model;
use DateTime;
use Exception;

class RegisterForm extends Model
{
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $gender = '';
    public string $password = '';
    public string $dateOfBirth = '';
    public string $passwordConfirm = '';
    public string $imgPath = '';

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_REQUIRED],
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
            'imgPath' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * @throws Exception
     */
    public function register(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $user = new User();
        $user->name = $this->name;
        $user->imgPath = $this->imgPath;
        $user->gender = $this->gender;
        $user->dateOfBirth = new DateTime($this->dateOfBirth);
        $user->password = $this->password;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $userId = $user->insertOrUpdateOne(false);
        if ($userId) {
            return true;
        }
        return false;
    }

    public function labels(): array
    {
        return [
            'name' => 'Your name',
            'phone' => 'Phone',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password confirm',
            'gender' => 'Gender',
            'dateOfBirth' => 'Date of birth',
            'imgPath' => 'Image path'
        ];
    }
}