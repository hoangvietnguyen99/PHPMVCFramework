<?php

use app\controllers\AdminController;
use app\core\Application;
use app\core\Router;

$adminRouter = new Router(Application::$application->request, Application::$application->response);

$adminRouter->get('/admin/users', [AdminController::class, 'users']);