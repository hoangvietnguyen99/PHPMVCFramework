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
use DateInterval;
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
    }

    public function ranking(Request $request)
    {

        if (isset($request->query['month']) && isset($request->query['year'])) {
            $month = $request->query['month'];
            $year = $request->query['year'];
            if ($month < 1) {
                $year = (string)((int)$year - 1);
                $month = '12';
            }
            if ($month > 12) {
                $year = (string)((int)$year + 1);
                $month = '1';
            }
            $monthRanking = new DateTime($year . '-' . $month . '-01', new DateTimeZone('GMT'));
        } else {
            $now = new DateTime('', new DateTimeZone('GMT'));
            $monthRanking = new DateTime($now->format('y') . '-' . $now->format('m') . '-01', new DateTimeZone('GMT'));
            // $monthRanking = new DateTime('2021-05-01', new DateTimeZone('GMT'));
            $month = $monthRanking->format('n');
            $year = $monthRanking->format('Y');
        }
        $top_user = User_month::getTopUser($monthRanking);
        //next month
        // $interval = new DateInterval('P10D');
        // $top_user_next = User_month::getTopUser(date_add($monthRanking, date_interval_create_from_date_string('1 months')));
        // $top_user_previous = User_month::getTopUser(date_sub($monthRanking, date_interval_create_from_date_string('1 months')));
        $monthNext = clone $monthRanking->add(new DateInterval('P1M'));
        $monthPrevious = $monthRanking->sub(new DateInterval('P2M'));
        $top_user_next = sizeof(User_month::getTopUser($monthNext)) == 0 ? false : true;
        $top_user_previous = sizeof(User_month::getTopUser($monthPrevious)) == 0 ? false : true;
        if (count($top_user) != 0) {
            return $this->render('ranking', [
                'top_user' => $top_user,
                'month' => $month,
                'year' => $year,
                'users_next' => $top_user_next,
                'users_previous' => $top_user_previous,
            ]);
        }
    }
}
