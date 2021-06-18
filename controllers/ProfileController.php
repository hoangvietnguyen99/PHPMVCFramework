<?php


namespace app\controllers;


use app\core\Controller;
use app\middlewares\AuthMiddleware;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function profile() {
        return $this->render('profile/overview', [
            'subLayout' => 'profile'
        ]);
    }

    public function changePassword() {
        return $this->render('profile/change-password', [
            'subLayout' => 'profile'
        ]);
    }

    public function personalInformation() {
        return $this->render('profile/personal-information', [
            'subLayout' => 'profile'
        ]);
    }

    public function accountInformation() {
        return $this->render('profile/account-information', [
            'subLayout' => 'profile'
        ]);
    }
}