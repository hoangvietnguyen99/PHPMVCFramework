<?php

use app\constants\Path;
use app\controllers\AuthController;
use app\core\Application;
use app\core\Router;

$authRouter = new Router(Application::$application->request, Application::$application->response);

$authRouter->get(Path::LOGOUT[0], [AuthController::class, 'logOut']);

$authRouter->post(Path::REGISTER[0], [AuthController::class, 'register']);
$authRouter->get(Path::REGISTER[0], [AuthController::class, 'getRegister']);
$authRouter->post(Path::LOGIN[0], [AuthController::class, 'logIn']);
$authRouter->get(Path::LOGIN[0], [AuthController::class, 'getLogIn']);

$authRouter->post(Path::FORGOT[0], [AuthController::class, 'forgetPassword']);
$authRouter->get(Path::FORGOT[0], [AuthController::class, 'getForgetPassword']);

$authRouter->post(Path::IS_NEW_EMAIL[0], [AuthController::class, 'isNewEmail']);
$authRouter->post(Path::IS_NEW_USERNAME[0], [AuthController::class, 'isNewUsername']);