<?php


namespace app\routes;


use app\constants\Path;
use app\controllers\ApiController;
use app\core\Request;
use app\core\Response;
use app\core\Router;

final class ApiRouter extends Router
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);

        $this->post(Path::API_ADD_CATEGORIES[0], [ApiController::class, 'addCategories']);

        $this->get(Path::API_GET_TAGS[0], [ApiController::class, 'getTags']);
        $this->post(Path::API_LOGIN[0], [ApiController::class, 'logIn']);

        $this->post(Path::API_IS_NEW_EMAIL[0], [ApiController::class, 'isNewEmail']);

        $this->get(Path::API_GET_CLOUDINARY_SIGNATURE[0], [ApiController::class, 'getCloudinarySignature']);

        $this->get(Path::API_QUESTIONS[0], [ApiController::class, 'getQuestions']);
        $this->post(Path::API_QUESTIONS[0], [ApiController::class, 'ask']);

        $this->post(Path::API_ANSWERS[0], [ApiController::class, 'answer']);

        $this->post(Path::API_LIKE[0], [ApiController::class, 'like']);
        $this->post(Path::API_DISLIKE[0], [ApiController::class, 'dislike']);
        $this->post(Path::API_REPORT[0], [ApiController::class, 'report']);
    }
}