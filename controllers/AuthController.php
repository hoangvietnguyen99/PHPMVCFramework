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
        $this->registerMiddleware(new GuestMiddleware(['signIn', 'signUp', 'forgetPassword']));
        $this->registerMiddleware(new AuthMiddleware(['signOut']));
    }

    public function signIn(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$application->session->setFlash('success', 'Welcome back');
                return Application::$application->response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function signUp(Request $request)
    {
        $registerModel = new RegisterForm();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                Application::$application->session->setFlash('success', 'Thanks for joining with us');
                return Application::$application->response->redirect('/signin');
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function forgetPassword(Request $request)
    {
        $forgetPasswordForm = new ForgetPasswordForm();
        if ($request->getMethod() === 'post') {
            $forgetPasswordForm->loadData($request->getBody());
            if ($forgetPasswordForm->validate() && $forgetPasswordForm->forgetPassword()) {
                Application::$application->session->setFlash('success', 'Check your email for the link');
                return Application::$application->response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('forgetPassword', [
            'model' => $forgetPasswordForm
        ]);
    }

    public function signOut(Request $request, Response $response)
    {
        Application::$application->logout();
        Application::$application->session->setFlash('success', 'See you later');
        return $response->redirect('/');
    }
}