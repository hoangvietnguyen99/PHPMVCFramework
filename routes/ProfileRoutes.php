<?php

use app\controllers\ProfileController;
use app\core\Application;
use app\core\Router;

$profileRouter = new Router(Application::$application->request, Application::$application->response);

$profileRouter->get('/profile', [ProfileController::class, 'profile']);
$profileRouter->get('/profile/account-information', [ProfileController::class, 'accountInformation']);
$profileRouter->get('/profile/personal-information', [ProfileController::class, 'personalInformation']);
$profileRouter->get('/profile/change-password', [ProfileController::class, 'changePassword']);