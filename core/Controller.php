<?php


namespace app\core;


class Controller
{
    public function render(string $view, array $params) {
        return Application::$application->router->renderView($view, $params);
    }
}