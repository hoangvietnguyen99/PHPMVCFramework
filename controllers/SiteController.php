<?php


namespace app\controllers;


use app\core\Controller;

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

    public function handleContact()
    {
        return 'Handling submitted data';
    }
}