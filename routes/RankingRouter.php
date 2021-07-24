<?php

use app\constants\Path;
use app\controllers\RankingController;
use app\core\Application;
use app\core\Router;

$rankingRouter = new Router(Application::$application->request, Application::$application->response);

$rankingRouter->get(Path::RANKING[0], [RankingController::class, 'ranking']);
