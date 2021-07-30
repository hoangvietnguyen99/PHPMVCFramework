<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use app\core\Router;
use app\models\User;
use app\routes\ApiRouter;
use app\routes\AuthRouter;
use app\routes\ProfileRouter;
use app\routes\QuestionRouter;
use app\routes\RankingRouter;
use app\routes\SiteRouter;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    "db" => [
        "LOCAL" => $_ENV["DB_CONNECTION_STRING_LOCAL"],
        "CLOUD" => $_ENV["DB_CONNECTION_STRING_CLOUD"],
        "TYPE" => $_ENV["DB_SOURCE"],
        "NAME" => $_ENV["DB_NAME"]
    ],
    "jwt" => [
        "SECRET" => $_ENV["SECRET"]
    ],
    "cloudinary" => [
        "SECRET" => $_ENV["CLOUDINARY_API_SECRET"],
        "KEY" => $_ENV["CLOUDINARY_API_KEY"]
    ],
    'censor' => $_ENV['CENSOR_SERVER']
];

$app = new Application(dirname(__DIR__), $config);

$request = $app->request;
$response = $app->response;

$app->routers[] = new AuthRouter($request, $response);
$app->routers[] = new SiteRouter($request, $response);
$app->routers[] = new ProfileRouter($request, $response);
$app->routers[] = new RankingRouter($request, $response);
$app->routers[] = new ApiRouter($request, $response);
$app->routers[] = new QuestionRouter($request, $response);

$app->run();