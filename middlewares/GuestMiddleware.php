<?php


namespace app\middlewares;


use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\middlewares\Middleware;

class GuestMiddleware extends Middleware
{
    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        if (!Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$application->controller->action, $this->actions)) {
                Application::$application->response->redirect('/');
            }
        }
    }
}