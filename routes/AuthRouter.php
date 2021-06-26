<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\AuthController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class AuthRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->get(Path::LOGOUT[0], [AuthController::class, 'logOut']);

        $this->post(Path::REGISTER[0], [AuthController::class, 'register']);
        $this->get(Path::REGISTER[0], [AuthController::class, 'register']);
        $this->post(Path::LOGIN[0], [AuthController::class, 'logIn']);
        $this->get(Path::LOGIN[0], [AuthController::class, 'logIn']);

        $this->post(Path::FORGOT[0], [AuthController::class, 'forgetPassword']);
        $this->get(Path::FORGOT[0], [AuthController::class, 'forgetPassword']);
    }
}