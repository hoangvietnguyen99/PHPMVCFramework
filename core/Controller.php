<?php


namespace app\core;


use app\core\middlewares\Middleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var Middleware[]
     */
    protected array $middlewares = [];

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render(string $view, $params = []): string
    {
        return Application::$application->view->renderView($view, $params);
    }

    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}