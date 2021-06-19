<?php

use app\controllers\AuthController;
use app\core\Application;
use app\core\Router;

$authRouter = new Router(Application::$application->request, Application::$application->response);

$authRouter->get('/logout', [AuthController::class, 'logOut']);

$authRouter->post('/register', [AuthController::class, 'register']);
$authRouter->get('/register', [AuthController::class, 'getRegister']);
$authRouter->post('/login', [AuthController::class, 'logIn']);
$authRouter->get('/login', [AuthController::class, 'getLogIn']);

$authRouter->post('/forgot', [AuthController::class, 'forgetPassword']);
$authRouter->get('/forgot', [AuthController::class, 'getForgetPassword']);

$authRouter->post('/isnewemail', [AuthController::class, 'isNewEmail']);
$authRouter->post('/isnewusername', [AuthController::class, 'isNewUsername']);