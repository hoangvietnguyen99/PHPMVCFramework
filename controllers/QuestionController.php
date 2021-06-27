<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exception\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\middlewares\AuthMiddleware;
use app\models\AskForm;
use app\models\Category;
use app\models\Question;
use app\models\AnswerForm;
use app\models\Tag;
use MongoDB\BSON\ObjectId;

class QuestionController extends Controller
{

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['ask']));
    }

    /**
     * @throws NotFoundException
     */
    public function reply(Request $request, Response $response)
    {
        $replyForm = new AnswerForm();
        $replyForm->loadData($request->body);
        if ($replyForm->validate() && $replyForm->reply()) {
            Application::$application->session->setFlash('success', 'Your reply is successfully submitted.');
            return $response->redirect('/questions?id=' . $replyForm->questionId);
        }
        $question = Question::findOne(['_id' => new ObjectId($replyForm->questionId)]);
        if (!$question) throw new NotFoundException();
        return $this->render('question', [
            'question' => $question,
            'model' => $replyForm
        ]);
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

    /**
     * @throws NotFoundException
     */
    public function questions(Request $request)
    {
        $questionId = $request->query['id'] ?? null;
        if ($questionId) {
            /** @var Question $question */
            $question = Question::findOne(['_id' => new ObjectId($questionId)]);
            if (!$question) throw new NotFoundException();
            $question->totalViews++;
            $question->insertOrUpdateOne();
            $replyForm = new AnswerForm();
            $replyForm->questionId = $questionId;
            return $this->render('question', [
                'question' => $question,
                'model' => $replyForm
            ]);
        }
        return $this->render('questions');
    }
}