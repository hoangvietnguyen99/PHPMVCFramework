<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\SiteController;
use app\controllers\AboutController;
use app\core\Application;
use app\models\User;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    "db" => [
        "LOCAL" => $_ENV["DB_CONNECTION_STRING_LOCAL"],
        "CLOUD" => $_ENV["DB_CONNECTION_STRING_CLOUD"],
        "TYPE" => $_ENV["DB_SOURCE"]
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/register', [SiteController::class, 'register']);
$app->router->post('/register', [SiteController::class, 'register']);
$app->router->get('/login', [SiteController::class, 'login']);
$app->router->post('/login', [SiteController::class, 'login']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->get('/about', [AboutController::class, 'index']);

$app->run();