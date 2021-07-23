<?php

namespace app\core;


use app\core\db\Database;
use app\core\exception\BaseException;
use app\core\exception\NotFoundException;
use app\models\User;
use Exception;

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
    /**
     * @var Router[]
     */
    public array $routers = [];
    public Database $database;
    public ?Controller $controller = null;
    public Session $session;
    public ?User $user;
    public View $view;
    public string $layout = 'main';
    public JWTHandler $jwt;

    public function __construct(string $rootPath, array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$application = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->database = new Database($config["db"]);
        $this->session = new Session();
        $this->view = new View();
        $this->jwt = new JWTHandler($config['jwt']);

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
            $result = null;
            foreach ($this->routers as $router) {
                $result = $router->resolve();
                if ($result) {
                    echo $result;
                    break;
                }
            }
            if (!$result) throw new NotFoundException();
        } catch (Exception $exception) {
            if ($exception instanceof BaseException) {
                if ($exception->renderWithView) {
                    $this->response->statusCode($exception->getCode());
                    echo $this->view->renderView('_error', [
                        'exception' => $exception
                    ]);
                } else {
                    $this->response->send($exception->getCode(), ['message' => $exception->getMessage()]);
                }
            } else {
                $this->response->statusCode(500);
                echo $this->view->renderView('_error', [
                    'exception' => $exception
                ]);
            }
        }
    }

    public function login($user)
    {
        $this->user = $user;
        $value = $user->getId();
        Application::$application->session->set('user', $value);
    }

    public function logout()
    {
        $this->user = null;
        self::$application->session->remove('user');
    }
}
