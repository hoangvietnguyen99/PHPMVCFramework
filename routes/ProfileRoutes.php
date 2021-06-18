<?php

use app\controllers\ProfileController;
use app\core\Application;
use app\core\Router;

$profileRouter = new Router(Application::$application->request, Application::$application->response);

$profileRouter->get('/profile', [ProfileController::class, 'profile']);