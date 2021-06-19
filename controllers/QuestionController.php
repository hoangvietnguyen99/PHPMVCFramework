<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\AuthMiddleware;
use app\models\Tag;

class QuestionController extends Controller
{

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['getAsk', 'ask']));
    }

    public function getAsk()
    {
        return $this->render('ask');
    }

    public function ask(Request $request)
    {
        echo '<pre>';
        var_dump($request->body);
        echo '</pre>';
        exit;
    }

    public function questions()
    {
        return $this->render('questions');
    }

    public function getTags(Request $request, Response $response)
    {
        $tags = Tag::find();
        return $response->send(200, $tags);
    }
}