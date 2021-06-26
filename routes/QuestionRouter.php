<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\QuestionController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class QuestionRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->get(Path::QUESTIONS[0], [QuestionController::class, 'questions']);

        $this->get(Path::ASK[0], [QuestionController::class, 'ask']);
        $this->post(Path::ASK[0], [QuestionController::class, 'ask']);
    }
}