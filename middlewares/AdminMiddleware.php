<?php


namespace app\middlewares;


use app\constants\Role;
use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\middlewares\Middleware;

class AdminMiddleware extends Middleware
{
    /**
     * @throws ForbiddenException
     */
    public function execute()
    {
        $user = Application::$application->user;
        $authMiddleware = new AuthMiddleware($this->actions);
        $authMiddleware->execute();
        if ($user->role !== Role::ADMIN) {
            if (empty($this->actions) || in_array(Application::$application->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}