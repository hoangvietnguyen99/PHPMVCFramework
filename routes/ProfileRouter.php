<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\ProfileController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class ProfileRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->get(Path::PROFILE[0], [ProfileController::class, 'account']);
        $this->post(Path::PROFILE_CHANGE_PASSWORD[0], [ProfileController::class, 'ChangePassword']);
        $this->get(Path::PROFILE_PERSONAL_INFORMATION[0], [ProfileController::class, 'getProfile']);
    }
}