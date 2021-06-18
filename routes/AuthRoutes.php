<?php

use app\controllers\AuthController;
use app\core\Application;
use app\core\Router;

$authRouter = new Router(Application::$application->request, Application::$application->response);

$authRouter->get('/signup', [AuthController::class, 'signUp']);
$authRouter->post('/signup', [AuthController::class, 'signUp']);
$authRouter->get('/signin', [AuthController::class, 'signIn']);
$authRouter->post('/signin', [AuthController::class, 'signIn']);
$authRouter->get('/signout', [AuthController::class, 'signOut']);
$authRouter->get('/forgetpassword', [AuthController::class, 'forgetPassword']);
$authRouter->post('/forgetpassword', [AuthController::class, 'forgetPassword']);