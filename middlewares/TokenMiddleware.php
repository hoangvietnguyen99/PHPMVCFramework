<?php


namespace app\middlewares;


use app\core\Application;
use app\core\exception\UnauthorizedException;
use app\core\middlewares\Middleware;
use Exception;

class TokenMiddleware extends Middleware
{

    /**
     * @throws UnauthorizedException
     */
    public function execute()
    {
        if (empty($this->actions) || in_array(Application::$application->controller->action, $this->actions)) {
            $request = Application::$application->request;
            $response = Application::$application->response;
            $token = $request->getBearerToken();
            if (!$token) throw new UnauthorizedException(false);
            $jwt = Application::$application->jwt;
            try {
                $jwt->validate($token);
            } catch (Exception $exception) {
                $response->send(401, ['message' => $exception->getMessage()]);
            }
        }
    }
}