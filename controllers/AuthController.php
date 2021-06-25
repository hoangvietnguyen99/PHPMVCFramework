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
use app\models\User;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new GuestMiddleware(['logIn', 'register', 'forgetPassword']));
        $this->registerMiddleware(new AuthMiddleware(['logOut']));
    }

    public function logIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->body);
            if ($loginForm->validate()) {
                $user = $loginForm->login();
                if ($user) {
                    Application::$application->session->setFlash('success', 'Welcome back');
                    return $response->redirect('/');
                }
            }
        }
        $this->setLayout('auth');
        return $this->render('auth/logIn', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request, Response $response)
    {
        $registerModel = new RegisterForm();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->body);
            if ($registerModel->validate() && $registerModel->register()) {
                Application::$application->session->setFlash('success', 'Thanks for joining with us');
                return $response->redirect('/login');
            }
        }
        $this->setLayout('auth');
        return $this->render('auth/register', [
            'model' => $registerModel
        ]);
    }

    public function forgetPassword(Request $request, Response $response)
    {
        $forgetPasswordForm = new ForgetPasswordForm();
        if ($request->getMethod() === 'post') {
            $forgetPasswordForm->loadData($request->body);
            if ($forgetPasswordForm->validate() && $forgetPasswordForm->forgetPassword()) {
                Application::$application->session->setFlash('success', 'Check your email for the link');
                return $response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('auth/forgot', [
            'model' => $forgetPasswordForm
        ]);
    }

    public function logOut(Request $request, Response $response)
    {
        Application::$application->logout();
        Application::$application->session->setFlash('success', 'See you later');
        return $response->redirect('/');
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