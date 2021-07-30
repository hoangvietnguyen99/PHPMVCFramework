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
use app\models\User;
use app\models\User_month;
use MongoDB\BSON\ObjectId;
use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

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
    public function answer(Request $request, Response $response)
    {
        $replyForm = new AnswerForm();
        $replyForm->loadData($request->body);
        if ($replyForm->validate() && $replyForm->answer()) {
            Application::$application->session->setFlash('success', 'Your answer is successfully submitted.');
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
            $question->answers = array_filter($question->answers, fn($answer) => $answer->isApproved);
            $replyForm = new AnswerForm();
            $replyForm->questionId = $questionId;
            return $this->render('question', [
                'question' => $question,
                'model' => $replyForm
            ]);
        }
        return $this->render('questions');
    }
    public function update_user_month(User $user, string $fieldname)
    {
        //check current month exits
        $now = new DateTime('', new DateTimeZone('GMT'));
        $monthRanking = new DateTime($now->format('y') . '-' . $now->format('m') . '-01', new DateTimeZone('GMT'));
        $user_month = User_month::findOne(['createdAt' => new UTCDateTime($monthRanking->getTimestamp() * 1000)]);
        if ($user_month != null) {
            User_month::updateUser($user_month, $user, $fieldname);
        } else {
            $user_month = new User_month();
            $user_month->insertOrUpdateOne();
            User_month::addUser($user_month, $user, $fieldname);
        }
    }
}
