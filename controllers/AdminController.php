<?php


namespace app\controllers;


use app\core\Controller;
use app\middlewares\AdminMiddleware;

class AdminController extends Controller
{


    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AdminMiddleware());
    }

    public function users()
    {
        return $this->render('admin/users');
    }
}