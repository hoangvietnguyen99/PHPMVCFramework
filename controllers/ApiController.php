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
use app\models\Answer;
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
            'addCategories', 'ask', 'answer', 'like', 'dislike', 'report'
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

        $filter = [];
        if (!isset($request->query['all']) || $request->query['all'] === 'F') {
            //            $filter['approved'] = true;
        }
        if (isset($request->query['search'])) {
            $filter['$text'] = ['$search' => $request->query['search']];
        }
        if (isset($request->query['category'])) {
            $filter['categories'] = array('$elemMatch' => array('_id' => new ObjectId($request->query['category'])));
        }
        if (isset($request->query['tag'])) {
            $filter['tags'] = array('$elemMatch' => array('_id' => new ObjectId($request->query['tag'])));
        }

        $options = array();
        if (isset($request->query['sort'])) {
            $options['sort'] = array($request->query['sort'] => +$request->query['order']);
        } else {
            $options['sort'] = array('publishDay' => -1);
        }
        $limit = $request->query['limit'] ?? 5;
        $skip = $request->query['skip'] ?? 0;
        $options['limit'] = +$limit;
        $options['skip'] = +$skip;
        $questions = Question::find($filter, $options);
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
                    $this->likeAnswer($answer, $user, $question, $response);
                }
            }
            throw new NotFoundException();
        }
        $this->likeQuestion($question, $user, $response);
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
                    $this->dislikeAnswer($answer, $user, $question, $response);
                }
            }
            throw new NotFoundException();
        }
        $this->dislikeQuestion($question, $user, $response);
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
        $content = $request->body["content"] ?? '';
        if (!$questionId || !$content || strlen($content) === 0) throw new BadRequestException();
        $question = Question::findOne(["_id" => new ObjectId($questionId)]);
        if (!$question) throw new NotFoundException();
        if ($answerId) {
            $answerId = new ObjectId($answerId);
            foreach ($question->answers as $answer) {
                if ($answer->getId() == $answerId) {
                    $this->reportAnswer($answer, $user, $question, $response, $content);
                }
            }
            throw new NotFoundException();
        }
        $this->reportQuestion($question, $user, $response, $content);
    }

    /**
     * @param Question $question
     * @param User $user
     * @param Response $response
     */
    public function likeQuestion(Question $question, User $user, Response $response): void
    {
        foreach ($question->likedUserIds as $key => $likedUserId) {
            if ($likedUserId == $user->getId()) {
                array_splice($question->likedUserIds, $key, 1);
                $question->author->totalLikes--;
                $question->author->score -= Score::NEW_LIKE;
                $question->author->updateOne();
                $question->updateOne();
                $response->send(200);
            }
        }
        $question->likedUserIds[] = $user->getId();
        $question->author->totalLikes++;
        $question->author->score += Score::NEW_LIKE;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }

    /**
     * @param Question $question
     * @param User $user
     * @param Response $response
     */
    public function dislikeQuestion(Question $question, User $user, Response $response): void
    {
        foreach ($question->dislikedUserIds as $key => $dislikedUserId) {
            if ($dislikedUserId == $user->getId()) {
                array_splice($question->dislikedUserIds, $key, 1);
                $question->author->totalDislikes--;
                $question->author->score -= Score::NEW_DISLIKE;
                $question->author->updateOne();
                $question->updateOne();
                $response->send(200);
            }
        }
        $question->dislikedUserIds[] = $user->getId();
        $question->author->totalDislikes++;
        $question->author->score += Score::NEW_DISLIKE;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }

    /**
     * @param Answer $answer
     * @param User $user
     * @param Question $question
     * @param Response $response
     */
    public function dislikeAnswer(Answer $answer, User $user, Question $question, Response $response): void
    {
        foreach ($answer->dislikedUserIds as $key => $dislikedUserId) {
            if ($dislikedUserId == $user->getId()) {
                array_splice($answer->dislikedUserIds, $key, 1);
                $answer->author->totalDislikes--;
                $answer->author->score -= Score::NEW_DISLIKE;
                $answer->author->updateOne();
                $question->updateOne();
                $response->send(200);
            }
        }
        $answer->dislikedUserIds[] = $user->getId();
        $answer->author->totalDislikes++;
        $answer->author->score += Score::NEW_DISLIKE;
        $answer->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }

    /**
     * @param Answer $answer
     * @param User $user
     * @param Question $question
     * @param Response $response
     */
    public function likeAnswer(Answer $answer, User $user, Question $question, Response $response): void
    {
        foreach ($answer->likedUserIds as $key => $likedUserId) {
            if ($likedUserId == $user->getId()) {
                array_splice($answer->likedUserIds, $key, 1);
                $answer->author->totalLikes--;
                $answer->author->score -= Score::NEW_LIKE;
                $answer->author->updateOne();
                $question->updateOne();
                $response->send(200);
            }
        }
        $answer->likedUserIds[] = $user->getId();
        $answer->author->totalLikes++;
        $answer->author->score += Score::NEW_LIKE;
        $answer->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }

    /**
     * @param Question $question
     * @param User $user
     * @param Response $response
     * @param string $content
     */
    public function reportQuestion(Question $question, User $user, Response $response, string $content): void
    {
        foreach ($question->reports as $report) {
            if ($report['_id'] == $user->getId()) {
                $response->send(409);
            }
        }
        $question->reports[] = (object) array('_id' => $user->getId(), 'content' => $content);
        $question->author->score += Score::NEW_REPORT;
        $question->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }

    /**
     * @param Answer $answer
     * @param User $user
     * @param Question $question
     * @param Response $response
     * @param string $content
     */
    public function reportAnswer(Answer $answer, User $user, Question $question, Response $response, string $content): void
    {
        foreach ($answer->reports as $report) {
            if ($report['_id'] == $user->getId()) {
                $response->send(409);
            }
        }
        $answer->reports[] = (object) array('_id' => $user->getId(), 'content' => $content);
        $answer->author->score += Score::NEW_REPORT;
        $answer->author->updateOne();
        $question->updateOne();
        $response->send(201);
    }
}
