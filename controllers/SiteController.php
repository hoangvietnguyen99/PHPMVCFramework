<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\AuthMiddleware;

class SiteController extends Controller
{
    /**
     * SiteController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function home(Request $request, Response $response)
    {
        return $response->redirect('/questions');
//        return $this->render('home');
    }

    public function contact()
    {
        return $this->render('contact');
    }
}