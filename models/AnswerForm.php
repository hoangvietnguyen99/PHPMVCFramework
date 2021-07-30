<?php


namespace app\models;


use app\constants\Score;
use app\core\Application;
use app\core\exception\NotFoundException;
use app\core\Model;
use app\controllers\QuestionController;
use app\utils\APIUtil;
use DateTime;
use MongoDB\BSON\ObjectId;

class AnswerForm extends Model
{
    public string $reply = '';
    public string $questionId = '';

    public function labels(): array
    {
        return [
            'reply' => 'Reply',
            'questionId' => 'Question Id'
        ];
    }

    public function rules(): array
    {
        return [
            'reply' => [
                self::RULE_REQUIRED
            ],
            'questionId' => [
                self::RULE_REQUIRED
            ]
        ];
    }

    /**
     * @throws NotFoundException
     */
    public function answer()
    {
        $questionId = new ObjectId($this->questionId);
        $question = Question::findOne(['_id' => $questionId]);
        if (!$question) throw new NotFoundException();
        $answerAuthor = Application::$application->user;
        $answer = new Answer($answerAuthor);
        $answer->content = $this->reply;
        $censorResult = APIUtil::CallAPI('POST', Application::$application->censorUri, array('inputText' => $answer->content));
        if ($censorResult === 'false') {
            $answer->publishDate = new DateTime();
            $answer->isApproved = true;
            $answerAuthor->score += Score::NEW_PUBLISH_ANSWER;
        }
        $answerAuthor->totalAnswers++;
        if ($answerAuthor->insertOrUpdateOne()) {
            $question->answers[] = $answer;
            if ($question->insertOrUpdateOne()) {
                $questionController = new QuestionController();
                $questionController->update_user_month($answerAuthor, 'totalAnswers');
                return true;
            }
        }
        return false;
    }
}