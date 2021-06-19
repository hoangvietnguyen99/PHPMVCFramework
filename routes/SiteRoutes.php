<?php

use app\constants\Path;
use app\controllers\SiteController;
use app\core\Application;
use app\core\Router;

$siteRouter = new Router(Application::$application->request, Application::$application->response);

$siteRouter->get(Path::HOME[0], [SiteController::class, 'home']);