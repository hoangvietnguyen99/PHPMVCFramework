<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\AdminMiddleware;
use app\models\Category;

class AdminController extends Controller
{
//    /**
//     * AdminController constructor.
//     */
//    public function __construct()
//    {
//        $this->registerMiddleware(new AdminMiddleware());
//    }

    public function users()
    {
        return $this->render('admin/userManagement');
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
}