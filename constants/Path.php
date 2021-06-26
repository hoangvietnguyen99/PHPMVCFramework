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

    public const PROFILE = ['/profile', 'Profile'];
    public const PROFILE_ACCOUNT_SETTINGS = [self::PROFILE[0] . '/account-settings', 'Account Settings'];
    public const PROFILE_PERSONAL_INFORMATION = [self::PROFILE[0] . '/personal-information', 'Personal Information'];
    public const PROFILE_CHANGE_PASSWORD = [self::PROFILE[0] . '/change-password', 'Change Password'];

    public const QUESTIONS = ['/questions', 'Questions'];
    public const ASK = ['/ask', 'Ask'];

    public const IS_NEW_EMAIL = ['/isnewemail', 'Is New Email'];

    public const LOGIN = ['/login', 'Log In'];
    public const LOGOUT = ['/logout', 'Log Out'];
    public const REGISTER = ['/register', 'Register'];
    public const FORGOT = ['/forgot', 'Forgot Password'];

    public const CATEGORIES = ['/categories', 'Categories'];

    public const API = ['/api'];
    public const API_IS_NEW_EMAIL = [self::API[0].'/isnewemail'];
    public const API_LOGIN = [self::API[0].'/login'];
    public const API_ADD_CATEGORIES = [self::API[0].'/categories'];
    public const API_GET_TAGS = [self::API[0].'/tags'];
}