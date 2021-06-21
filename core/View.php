<?php


namespace app\core;


class View
{
    public string $title = '';
    public array $scripts = [];

    public function renderView(string $view, array $params = [])
    {
        $layoutName = Application::$application->layout;
        if (Application::$application->controller) {
            $layoutName = Application::$application->controller->layout;
        }
        $viewContent = $this->renderViewOnly($view, $params);
        if (!$layoutName) return $viewContent;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        $layoutContent = str_replace('{{content}}', $viewContent, $layoutContent);
        return str_replace('{{scripts}}', implode('', $this->scripts), $layoutContent);
    }

    public function renderViewOnly(string $view, array $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}