<?php

use app\controllers\AuthController;
use app\core\Application;
use app\core\Router;

$authRouter = new Router(Application::$application->request, Application::$application->response);

$authRouter->get('/auth', [AuthController::class, 'getAuth']);
$authRouter->get('/signout', [AuthController::class, 'signOut']);

$authRouter->post('/signup', [AuthController::class, 'signUp']);
$authRouter->post('/signin', [AuthController::class, 'signIn']);

$authRouter->post('/forget', [AuthController::class, 'forgetPassword']);