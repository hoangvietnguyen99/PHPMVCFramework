<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\RankingController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class RankingRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->get(Path::RANKING[0], [RankingController::class, 'ranking']);
    }
}