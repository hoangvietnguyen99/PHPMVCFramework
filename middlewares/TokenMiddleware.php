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
            if (Application::$application->user) return;
            $request = Application::$application->request;
            $token = $request->getBearerToken();
            if (!$token) throw new UnauthorizedException();
            $jwt = Application::$application->jwt;
            try {
                $jwt->validate($token);
            } catch (Exception $exception) {
                $newException = new UnauthorizedException();
                $newException->setMessage($exception->getMessage());
                throw $newException;
            }
        }
    }
}