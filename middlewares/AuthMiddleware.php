<?php


namespace app\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\middlewares\Middleware;

class AuthMiddleware extends Middleware
{
    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$application->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}