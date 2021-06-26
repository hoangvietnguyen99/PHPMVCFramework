<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Category;
use app\models\LoginForm;
use app\models\Tag;
use app\models\User;

class ApiController extends Controller
{
    public function logIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->body);
        if ($loginForm->validate()) {
            $user = $loginForm->login(false);
            if ($user) {
                $jwt = Application::$application->jwt->generateJWT($user);
                return $response->send(200, ['token' => $jwt]);
            }
            return $response->send(401, $loginForm->errors);
        }
        return $response->send(401, $loginForm->errors);
    }

    public function getTags(Request $request, Response $response)
    {
        $tags = Tag::find();
        return $response->send(200, $tags);
    }

    public function addCategories(Request $request, Response $response)
    {
        $body = $request->body;
        foreach ($body as $item) {
            $category = new Category();
            $category->loadData($item);
            $category->insertOrUpdateOne();
        }
        return $response->send(201);
    }

    public function isNewEmail(Request $request, Response $response)
    {
        $data = $request->body;
        if (!isset($data['email'])) return $response->send(200, ['canCreate' => false]);
        $user = User::findOne(['email' => $data['email']]);
        if ($user) return $response->send(200, ['canCreate' => false]);
        return $response->send(200, ['canCreate' => true]);
    }
}