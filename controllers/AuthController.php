<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\AuthMiddleware;
use app\middlewares\GuestMiddleware;
use app\models\ForgetPasswordForm;
use app\models\LoginForm;
use app\models\RegisterForm;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new GuestMiddleware(['getAuth', 'signIn', 'signUp', 'forgetPassword']));
        $this->registerMiddleware(new AuthMiddleware(['signOut']));
    }

    public function getAuth(): string
    {
        $this->setLayout('');
        return $this->render('auth');
    }

    public function signIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->getBody());
        if ($loginForm->validate() && $loginForm->login()) {
            Application::$application->session->setFlash('success', 'Welcome back');
            return $response->send(200);
        }
        return $response->send(401, $loginForm->errors);
    }

    public function signUp(Request $request, Response $response)
    {
        $registerModel = new RegisterForm();
        $registerModel->loadData($request->getBody());
        if ($registerModel->validate() && $registerModel->register()) {
            Application::$application->session->setFlash('success', 'Thanks for joining with us');
            return $response->send(201);
        }
        return $response->send(400, $registerModel->errors);
    }

    public function forgetPassword(Request $request, Response $response)
    {
        $forgetPasswordForm = new ForgetPasswordForm();
        $forgetPasswordForm->loadData($request->getBody());
        return json_encode($request->getBody());
        if ($forgetPasswordForm->validate() && $forgetPasswordForm->forgetPassword()) {
            Application::$application->session->setFlash('success', 'Check your email for the link');
            return $response->send(200);
        }
        return $response->send(400, $forgetPasswordForm->errors);
    }

    public function signOut(Request $request, Response $response)
    {
        Application::$application->logout();
        Application::$application->session->setFlash('success', 'See you later');
        return $response->redirect('/');
    }
}