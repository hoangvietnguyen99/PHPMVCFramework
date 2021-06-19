<?php

use app\constants\Path;
use app\controllers\ProfileController;
use app\core\Application;
use app\core\Router;

$profileRouter = new Router(Application::$application->request, Application::$application->response);

$profileRouter->get(Path::PROFILE[0], [ProfileController::class, 'profile']);