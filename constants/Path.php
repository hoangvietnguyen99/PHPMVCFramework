<?php


namespace app\constants;


use ReflectionClass;

final class Path
{
    static function getConstants(): array
    {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }

    public const HOME = ['/', 'Home'];

    public const PROFILE = ['/account', 'accout'];
    public const PROFILE_ACCOUNT_SETTINGS = [self::PROFILE[0] . '/account-settings', 'Account Settings'];
    public const PROFILE_PERSONAL_INFORMATION = ['/profile', 'Personal Information'];
    public const PROFILE_CHANGE_PASSWORD = [self::PROFILE[0] . '/change-password', 'Change Password'];

    public const RANKING = ['/ranking', 'ranking'];

    public const QUESTIONS = ['/questions', 'Questions'];
    public const ASK = ['/ask', 'Ask'];
    public const REPLY = ['/reply', 'Reply'];

    public const IS_NEW_EMAIL = ['/isnewemail', 'Is New Email'];

    public const LOGIN = ['/login', 'Log In'];
    public const LOGOUT = ['/logout', 'Log Out'];
    public const REGISTER = ['/register', 'Register'];
    public const FORGOT = ['/forgot', 'Forgot Password'];

    public const CATEGORIES = ['/categories', 'Categories'];

    public const API = ['/api'];
    public const API_IS_NEW_EMAIL = [self::API[0] . '/isnewemail'];
    public const API_LOGIN = [self::API[0] . '/login'];
    public const API_ADD_CATEGORIES = [self::API[0] . '/categories'];
    public const API_GET_TAGS = [self::API[0] . '/tags'];
    public const API_GET_CLOUDINARY_SIGNATURE = [self::API[0] . '/cloudinary-signature'];
    public const API_QUESTIONS = [self::API[0] . '/questions'];
    public const API_ANSWERS = [self::API[0] . '/answers'];
    public const API_ASK = [self::API[0] . '/ask'];
}
