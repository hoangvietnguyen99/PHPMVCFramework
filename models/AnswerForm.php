<?php


namespace app\models;


use app\constants\Score;
use app\core\Application;
use app\core\exception\NotFoundException;
use app\core\Model;
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
    public function reply()
    {
        $questionId = new ObjectId($this->questionId);
        /** @var Question $question */
        $question = Question::findOne(['_id' => $questionId]);
        if (!$question) throw new NotFoundException();
        /** @var User $questionAuthor */
        $answerAuthor = Application::$application->user;
        $answer = new Answer($answerAuthor);
        $answer->content = $this->reply;
        $answerAuthor->totalAnswers++;
        if ($answerAuthor->insertOrUpdateOne()) {
            $question->answers[] = $answer;
            if ($question->insertOrUpdateOne()) {
                return true;
            }
        }
        return false;
    }
}