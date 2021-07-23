<?php

use app\constants\Path;
use app\controllers\ProfileController;
use app\core\Application;
use app\core\Router;

$profileRouter = new Router(Application::$application->request, Application::$application->response);

$profileRouter->get(Path::PROFILE[0], [ProfileController::class, 'account']);
$profileRouter->post(Path::PROFILE_CHANGE_PASSWORD[0], [ProfileController::class, 'ChangePassword']);
$profileRouter->get(Path::PROFILE_PERSONAL_INFORMATION[0], [ProfileController::class, 'getProfile']);

