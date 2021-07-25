<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\SiteController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class SiteRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->get(Path::HOME[0], [SiteController::class, 'home']);
    }
}