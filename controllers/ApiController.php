<?php


namespace app\controllers;


use app\core\Application;
use app\core\CloudinaryUploadHandler;
use app\core\Controller;
use app\core\exception\BadRequestException;
use app\core\exception\NotFoundException;
use app\core\exception\UnauthorizedException;
use app\core\Request;
use app\core\Response;
use app\middlewares\TokenMiddleware;
use app\models\AnswerForm;
use app\models\AskForm;
use app\models\Category;
use app\models\LoginForm;
use app\models\Question;
use app\models\Tag;
use app\models\User;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use MongoDB\BSON\ObjectId;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new TokenMiddleware([
            'addCategories'
        ]));
    }

    /**
     * @throws Exception
     */
    #[NoReturn] public function logIn(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        $loginForm->loadData($request->body);
        if ($loginForm->validate()) {
            /** @var User $user */
            $user = $loginForm->login(false);
            if ($user) {
                $jwt = Application::$application->jwt->generateJWT($user);
                $response->send(200, ['token' => $jwt]);
            }
            $response->send(401, $loginForm->errors);
        }
        $response->send(401, $loginForm->errors);
    }

    #[NoReturn] public function getTags(Request $request, Response $response)
    {
        $tags = Tag::find();
        $response->send(200, $tags);
    }

    #[NoReturn] public function addCategories(Request $request, Response $response)
    {
        $body = $request->body;
        foreach ($body as $item) {
            $category = new Category();
            $category->loadData($item);
            $category->insertOrUpdateOne();
        }
        $response->send(201);
    }

    #[NoReturn] public function isNewEmail(Request $request, Response $response)
    {
        $data = $request->body;
        if (!isset($data['email'])) $response->send(200, ['canCreate' => false]);
        $user = User::findOne(['email' => $data['email']]);
        if ($user) $response->send(200, ['canCreate' => false]);
        $response->send(200, ['canCreate' => true]);
    }

    #[NoReturn] public function getCloudinarySignature(Request $request, Response $response)
    {
        $data = $request->query;
        $response->send(200, Application::$application->cloudinaryUploadHandler->getSignature($data['public_id'] ?? ''));
    }

    /**
     * @throws BadRequestException|NotFoundException
     */
    #[NoReturn] public function answer(Request $request, Response $response)
    {
        $replyForm = new AnswerForm();
        $replyForm->loadData($request->body);
        if ($replyForm->validate() && $replyForm->answer()) {
            $response->send(201, [
                'message' => 'Your reply is successfully submitted.'
            ]);
        }
        throw new BadRequestException();
    }

    public function getAnswers(Request $request, Response $response)
    {
        if (isset($request->query['question_id'])) {

        }
    }

    #[NoReturn] public function ask(Request $request, Response $response)
    {
        $askForm = new AskForm();
        $askForm->loadData($request->body);
        if ($askForm->validate() && $askForm->ask()) {
            $response->send(201, [
                'message' => 'Your question is successfully submitted.'
            ]);
        } else {
            $response->send(400);
        }
    }

    /**
     * @throws NotFoundException
     */
    public function getQuestions(Request $request)
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