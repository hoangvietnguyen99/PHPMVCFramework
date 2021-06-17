<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
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

$app->router->get('/signup', [AuthController::class, 'signUp']);
$app->router->post('/signup', [AuthController::class, 'signUp']);
$app->router->get('/signin', [AuthController::class, 'signIn']);
$app->router->post('/signin', [AuthController::class, 'signIn']);
$app->router->get('/signout', [AuthController::class, 'signOut']);
$app->router->get('/forgetpassword', [AuthController::class, 'forgetPassword']);
$app->router->post('/forgetpassword', [AuthController::class, 'forgetPassword']);

$app->router->get('/profile', [SiteController::class, 'profile']);

$app->run();