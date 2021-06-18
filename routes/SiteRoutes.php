<?php

use app\controllers\SiteController;
use app\core\Application;
use app\core\Router;

$siteRouter = new Router(Application::$application->request, Application::$application->response);

$siteRouter->get('/', [SiteController::class, 'home']);
$siteRouter->get('/contact', [SiteController::class, 'contact']);