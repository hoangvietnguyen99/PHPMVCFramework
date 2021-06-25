<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;

class ApiController extends Controller
{
    public function logIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->body);
        if ($loginForm->validate()) {
            $user = $loginForm->login();
            if ($user) {
                $jwt = Application::$application->jwt->generateJWT($user);
                return $response->send(200, ['token' => $jwt]);
            }
            return $response->send(401, ['user' => 'User not found']);
        }
        return $response->send(401, $loginForm->errors);
    }
}