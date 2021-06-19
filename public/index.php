<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;
use app\core\Router;
use app\models\User;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    "db" => [
        "LOCAL" => $_ENV["DB_CONNECTION_STRING_LOCAL"],
        "CLOUD" => $_ENV["DB_CONNECTION_STRING_CLOUD"],
        "TYPE" => $_ENV["DB_SOURCE"],
        "NAME" => $_ENV["DB_NAME"]
    ]
];

$app = new Application(dirname(__DIR__), $config);

/**
 * @var $authRouter Router
 * @var $siteRouter Router
 * @var $profileRouter Router
 * @var $adminRouter Router
 */
include_once __DIR__.'/../routes/AuthRoutes.php';
include_once __DIR__.'/../routes/SiteRoutes.php';
include_once __DIR__.'/../routes/ProfileRoutes.php';
include_once __DIR__.'/../routes/AdminRoutes.php';

$app->routers[] = $authRouter;
$app->routers[] = $siteRouter;
$app->routers[] = $profileRouter;
$app->routers[] = $adminRouter;

$app->run();