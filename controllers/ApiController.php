<?php


namespace app\controllers;


use app\constants\Score;
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
            'addCategories', 'getQuestions', 'ask', 'answer', 'like', 'dislike', 'report'
        ]));
    }

    /**
     * @throws Exception
     */
    public function logIn(Request $request, Response $response)
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

    public function getTags(Request $request, Response $response)
    {
        $tags = Tag::find();
        $response->send(200, $tags);
    }

    public function addCategories(Request $request, Response $response)
    {
        $body = $request->body;
        foreach ($body as $item) {
            $category = new Category();
            $category->loadData($item);
            $category->insertOrUpdateOne();
        }
        $response->send(201);
    }

    public function isNewEmail(Request $request, Response $response)
    {
        $data = $request->body;
        if (!isset($data['email'])) $response->send(200, ['canCreate' => false]);
        $user = User::findOne(['email' => $data['email']]);
        if ($user) $response->send(200, ['canCreate' => false]);
        $response->send(200, ['canCreate' => true]);
    }

    public function getCloudinarySignature(Request $request, Response $response)
    {
        $data = $request->query;
        $response->send(200, Application::$application->cloudinaryUploadHandler->getSignature($data['public_id'] ?? ''));
    }

    /**
     * @throws BadRequestException|NotFoundException
     */
    public function answer(Request $request, Response $response)
    {
        $replyForm = new AnswerForm();
        $replyForm->loadData($request->body);
        if ($replyForm->validate()) {
            if ($replyForm->answer()) {
                $response->send(201, [
                    'message' => 'Your reply is successfully submitted.'
                ]);
            }
            throw new BadRequestException();
        }
        $response->send(400, $replyForm->errors);
    }

    /**
     * @throws NotFoundException
     */
    public function getQuestions(Request $request, Response $response)
    {
        if (isset($request->query['id'])) {
            $question = Question::findOne(['_id' => new ObjectId($request->query['id'])]);
            if ($question) $response->send(200, $question);
            throw new NotFoundException();
        }
        $questions = Question::find();
        foreach ($questions as $question) {
            $question->answers = [];
        }
        $response->send(200, $questions);
    }

    /**
     * @throws BadRequestException
     */
    public function ask(Request $request, Response $response)
    {
        $askForm = new AskForm();
        $askForm->loadData($request->body);
        if ($askForm->validate()) {
            if ($askForm->ask()) {
                $response->send(201, [
                    'message' => 'Your question is successfully submitted.'
                ]);
            }
            throw new BadRequestException();
        }
        $response->send(400, $askForm->errors);
    }

    /**
     * @throws BadRequestException
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function like(Request $request, Response $response)
    {
        $user = Application::$application->user;
        if (!$user) throw new UnauthorizedException();
        $questionId = $request->body["question_id"] ?? null;
        $answerId = $request->body["answer_id"] ?? null;
        if (!$questionId) throw new BadRequestException();
        $question = Question::findOne(["_id" => new ObjectId($questionId)]);
        if (!$question) throw new NotFoundException();
        if ($answerId) {
            $answerId = new ObjectId($answerId);
            foreach ($question->answers as $answer) {
                if ($answer->getId() == $answerId) {
                    foreach ($answer->likedUserIds as $likedUserId) {
                        if ($likedUserId == $user->getId()) {
                            $response->send(409);
                        }
                    }
                    $answer->likedUserIds[] = $user->getId();
                    $answer->author->totalLikes++;
                    $answer->author->score += Score::NEW_LIKE;
                    $answer->author->updateOne();
                    $question->updateOne();
                    $response->send(200);
                }
            }
            throw new NotFoundException();
        }
        foreach ($question->likedUserIds as $likedUserId) {
            if ($likedUserId == $user->getId()) {
                $response->send(409);
            }
        }
        $question->likedUserIds[] = $user->getId();
        $question->author->totalLikes++;
        $question->author->score += Score::NEW_LIKE;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(200);
    }

    /**
     * @throws UnauthorizedException
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function dislike(Request $request, Response $response)
    {
        $user = Application::$application->user;
        if (!$user) throw new UnauthorizedException();
        $questionId = $request->body["question_id"] ?? null;
        $answerId = $request->body["answer_id"] ?? null;
        if (!$questionId) throw new BadRequestException();
        $question = Question::findOne(["_id" => new ObjectId($questionId)]);
        if (!$question) throw new NotFoundException();
        if ($answerId) {
            $answerId = new ObjectId($answerId);
            foreach ($question->answers as $answer) {
                if ($answer->getId() == $answerId) {
                    foreach ($answer->dislikedUserIds as $dislikedUserId) {
                        if ($dislikedUserId == $user->getId()) {
                            $response->send(409);
                        }
                    }
                    $answer->dislikedUserIds[] = $user->getId();
                    $answer->author->totalDislikes++;
                    $answer->author->score += Score::NEW_DISLIKE;
                    $answer->author->updateOne();
                    $question->updateOne();
                    $response->send(200);
                }
            }
            throw new NotFoundException();
        }
        foreach ($question->dislikedUserIds as $dislikedUserId) {
            if ($dislikedUserId == $user->getId()) {
                $response->send(409);
            }
        }
        $question->dislikedUserIds[] = $user->getId();
        $question->author->totalDislikes++;
        $question->author->score += Score::NEW_DISLIKE;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(200);
    }

    /**
     * @throws UnauthorizedException
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function report(Request $request, Response $response)
    {
        $user = Application::$application->user;
        if (!$user) throw new UnauthorizedException();
        $questionId = $request->body["question_id"] ?? null;
        $answerId = $request->body["answer_id"] ?? null;
        $content = $request->body["content"] ?? null;
        if (!$questionId || !$content || strlen($content) === 0) throw new BadRequestException();
        $question = Question::findOne(["_id" => new ObjectId($questionId)]);
        if (!$question) throw new NotFoundException();
        if ($answerId) {
            $answerId = new ObjectId($answerId);
            foreach ($question->answers as $answer) {
                if ($answer->getId() == $answerId) {
                    foreach ($answer->dislikedUserIds as $dislikedUserId) {
                        if ($dislikedUserId == $user->getId()) {
                            $response->send(409);
                        }
                    }
                    $answer->dislikedUserIds[] = $user->getId();
                    $answer->author->totalDislikes++;
                    $answer->author->score += Score::NEW_DISLIKE;
                    $answer->author->updateOne();
                    $question->updateOne();
                    $response->send(200);
                }
            }
            throw new NotFoundException();
        }
        foreach ($question->dislikedUserIds as $dislikedUserId) {
            if ($dislikedUserId == $user->getId()) {
                $response->send(409);
            }
        }
        $question->dislikedUserIds[] = $user->getId();
        $question->author->totalDislikes++;
        $question->author->score += Score::NEW_DISLIKE;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(200);
    }
}