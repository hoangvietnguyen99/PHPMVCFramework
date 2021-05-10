<?php


namespace app\controllers;


use app\core\Controller;

class AuthController extends Controller
{
    public function login() {
        return $this->render('login', [
            'title' => 'Login'
        ]);
    }

    public function register() {
        return $this->render('register', [
            'title' => 'Register'
        ]);
    }

    public function handleLogin() {
        return $this->render('login', [
            'title' => 'Login'
        ]);
    }

    public function handleRegister() {
        return $this->render('register', [
            'title' => 'Register'
        ]);
    }
}