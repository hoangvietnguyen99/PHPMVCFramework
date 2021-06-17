<?php


namespace app\models;


use app\core\Application;
use app\core\Model;

class ForgetPasswordForm extends Model
{
    public string $email = '';

    public function labels(): array
    {
        return [
            'email' => 'Your email'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    public function forgetPassword()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        return true;
    }
}