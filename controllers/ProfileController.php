<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\middlewares\AuthMiddleware;
use app\models\User;
use MongoDB\BSON\ObjectId;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function profile(Request $request) {
        $user = User::findOne(['_id' => new ObjectId($request->query['id'])]);

        return $this->render('profile', [
            'user' => $user
        ]);
    }
}