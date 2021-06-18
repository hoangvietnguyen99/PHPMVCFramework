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
        return $this->render('profile');
    }
}