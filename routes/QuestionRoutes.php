<?php

use app\constants\Path;
use app\controllers\QuestionController;
use app\core\Application;
use app\core\Router;

$questionRouter = new Router(Application::$application->request, Application::$application->response);

$questionRouter->get(Path::QUESTIONS[0], [QuestionController::class, 'questions']);

$questionRouter->get(Path::ASK[0], [QuestionController::class, 'getAsk']);
$questionRouter->post(Path::ASK[0], [QuestionController::class, 'ask']);

$questionRouter->get(Path::TAGS[0], [QuestionController::class, 'getTags']);