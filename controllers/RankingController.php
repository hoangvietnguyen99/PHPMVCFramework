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

class RankingController extends Controller
{

    /**
     * QuestionController constructor.
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['ranking']));
    }

    /**
     * @throws NotFoundException
     */
    public function ranking(){
        return $this->render('ranking',[]);
    }
}
