<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home', [
            'title' => 'Home'
        ]);
    }

    public function contact()
    {
        return $this->render('contact', [
            'title' => 'Contact'
        ]);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return $body;
    }
}