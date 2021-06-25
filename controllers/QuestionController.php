<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\middlewares\AuthMiddleware;
use app\models\AskForm;
use app\models\Category;
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

    public function ask(Request $request, Response $response)
    {
        $askForm = new AskForm();
        if ($request->getMethod() === 'post') {
            $askForm->loadData($request->body);
            if ($askForm->validate() && $askForm->ask()) {
                Application::$application->session->setFlash('success', 'Your question is successfully submitted.');
                return $response->redirect('/questions');
            }
        }
        $categories = Category::find();
        return $this->render('ask', [
            'model' => $askForm,
            'categories' => $categories
        ]);
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