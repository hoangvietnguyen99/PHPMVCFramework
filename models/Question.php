<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Question extends DbModel
{
    public string $title = '';
    public string $content = '';
    public bool $isDeleted = false;
    public DateTime $createdDate;
    public User $author;
    public bool $isApproved = false;
    public ?ObjectId $approvedBy = null;
    public ?DateTime $publishDate = null;
    public array $category = [];
    public array $tags = [];
    /** @var Label[] $labels */
    public array $labels = [];
    /** @var Answer[] $answers */
    public array $answers = [];
    public int $totalLikes = 0;
    public int $totalDislikes = 0;
    public int $totalViews = 0;
    public float $averageRate = 0;
    public int $totalAnswers = 0;

    /**
     * Question constructor.
     * @param User $author
     */
    public function __construct(User $author)
    {
        parent::__construct();
        $this->author = $author;
        $this->createdDate = new DateTime();
    }


    public static function collectionName(): string
    {
        return 'QUESTIONS';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'isDeleted' => $this->isDeleted,
            'averageRate' => ($this->totalLikes - $this->totalDislikes) / (($this->totalLikes + $this->totalDislikes) || 1),
            'title' => $this->title,
            'content' => $this->content,
            'createdAt' => new UTCDateTime($this->createdDate->getTimestamp() * 1000),
            'author' => $this->author->_id,
            'authorName' => $this->author->name,
            'approved' => $this->isApproved,
            'appovedBy' => $this->approvedBy,
            'publishDay' => $this->publishDate ? new UTCDateTime($this->publishDate->getTimestamp() * 1000) : null,
            'category' => $this->category,
            'tags' => $this->tags,
            'labels' => $this->labels,
            'answers' => $this->answers,
            'numofLiked' => $this->totalLikes,
            'numofDisliked' => $this->totalDislikes,
            'totalViews' => $this->totalViews,
            'totalAnswer' => count($this->answers),
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->title = $data['title'];
        $this->isDeleted = $data['isDeleted'];
        $this->content = $data['content'];
        $this->createdDate = $data['createdAt']->toDateTime();
        $this->author = User::findOne(['_id' => $data['author']]);
        $this->isApproved = $data['approved'];
        $this->averageRate = $data['averageRate'];
        $this->approvedBy = $data['approvedBy'];
        $this->publishDate = $data['publishDay'] ? $data['publishDay']->toDateTime() : null;
        $this->totalLikes = $data['numofLiked'];
        $this->totalDislikes = $data['numofDisliked'];
        $this->totalViews = $data['totalViews'];
        $this->totalAnswers = $data['totalAnswer'];
        foreach ($data['category'] as $category) {
            $this->category[] = $category;
        }
        foreach ($data['tags'] as $tag) {
            $this->tags[] = $tag;
        }
        foreach ($data['labels'] as $label) {
            $this->labels[] = $label;
        }
        foreach ($data['answers'] as $answer) {
            $this->answers[] = $answer;
        }
    }
}