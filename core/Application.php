<?php

namespace app\core;


use app\core\db\Database;
use app\models\User;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public static Application $application;
    public string $userClass;
    public Request $request;
    public Response $response;
    public Router $router;
    public Database $database;
    public ?Controller $controller = null;
    public Session $session;
    public ?User $user;
    public View $view;
    public string $layout = 'main';

    public function __construct(string $rootPath, array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$application = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->database = new Database($config["db"]);
        $this->session = new Session();
        $this->view = new View();

        $userId = Application::$application->session->get('user');
        if ($userId) {
            $this->user = $this->userClass::findOne(["_id" => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$application->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $exception) {
            $this->response->statusCode($exception->getCode());
            echo $this->view->renderView('_error', [
               'exception' => $exception
            ]);
        }
    }

    public function login(User $user)
    {
        $this->user = $user;
        $value = $user->getId();
        Application::$application->session->set('user', $value);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$application->session->remove('user');
    }
}