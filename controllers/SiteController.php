<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\RegisterForm;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home', [
            'name' => Application::$application->user ? Application::$application->user->getDisplayName() : ''
        ]);
    }

    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->getMethod() === 'post') {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$application->response->redirect('/');
                return 'Login success.';
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }


    public function register(Request $request)
    {
        $registerModel = new RegisterForm();
        if ($request->getMethod() === 'post') {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                Application::$application->session->setFlash('success', 'Thanks for registering');
                Application::$application->response->redirect('/');
                return 'Register success.';
            }
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$application->logout();
        $response->redirect('/');
    }

    public function contact()
    {
        return $this->render('contact');
    }
}