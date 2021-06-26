<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\TokenMiddleware;
use app\models\Category;
use app\models\LoginForm;
use app\models\Tag;
use app\models\User;
use Exception;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new TokenMiddleware([
            'addCategories'
        ]));
    }

    /**
     * @throws Exception
     */
    public function logIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->body);
        if ($loginForm->validate()) {
            /** @var User $user */
            $user = $loginForm->login(false);
            if ($user) {
                $jwt = Application::$application->jwt->generateJWT($user);
                $response->send(200, ['token' => $jwt]);
            }
            $response->send(401, $loginForm->errors);
        }
        $response->send(401, $loginForm->errors);
    }

    public function getTags(Request $request, Response $response)
    {
        $tags = Tag::find();
        $response->send(200, $tags);
    }

    public function addCategories(Request $request, Response $response)
    {
        $body = $request->body;
        foreach ($body as $item) {
            $category = new Category();
            $category->loadData($item);
            $category->insertOrUpdateOne();
        }
        $response->send(201);
    }

    public function isNewEmail(Request $request, Response $response)
    {
        $data = $request->body;
        if (!isset($data['email'])) $response->send(200, ['canCreate' => false]);
        $user = User::findOne(['email' => $data['email']]);
        if ($user) $response->send(200, ['canCreate' => false]);
        $response->send(200, ['canCreate' => true]);
    }
}