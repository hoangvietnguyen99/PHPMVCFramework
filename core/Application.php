<?php

namespace app\core;


use MongoDB\Model\BSONDocument;

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
    public Controller $controller;
    public Session $session;
    public ?DbModel $user;

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

        $userId = Application::$application->session->get('user');
        if ($userId) {
            $key = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$key => $userId]);
        }
    }

    public static function isGuest()
    {
        return !self::$application->user;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $value = $user->{$primaryKey};
        Application::$application->session->set('user', $value);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        self::$application->session->remove('user');
    }
}