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
    public ?User $approvedBy = null;
    public ?DateTime $publishDate = null;
    /** @var Category[] $categories */
    public array $categories = [];
    /** @var Tag[] $tags */
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
    public bool $adIsNotified = false;
    public bool $adIsSeen = false;

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
            'appovedBy' => $this->approvedBy ? $this->approvedBy->_id : null,
            'publishDay' => $this->publishDate ? new UTCDateTime($this->publishDate->getTimestamp() * 1000) : null,
            'category' => array_map(fn($item) => [
                '_id' => $item->getId(),
                'name' => $item->name
            ], $this->categories),
            'tags' => array_map(fn($item) => [
                '_id' => $item->getId(),
                'name' => $item->name
            ], $this->tags),
            'labels' => array_map(fn($item) => [
                '_id' => $item->getId(),
                'name' => $item->name
            ], $this->labels),
            'answers' => $this->answers,
            'numofLiked' => $this->totalLikes,
            'numofDisliked' => $this->totalDislikes,
            'totalViews' => $this->totalViews,
            'totalAnswer' => count($this->answers),
            'adIsNotified' => $this->adIsNotified,
            'adIsSeen' => $this->adIsSeen,
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
        $this->approvedBy = $data['appovedBy'] ? User::findOne(['_id' => $data['appovedBy']]) : null;
        $this->publishDate = $data['publishDay'] ? $data['publishDay']->toDateTime() : null;
        $this->totalLikes = $data['numofLiked'];
        $this->totalDislikes = $data['numofDisliked'];
        $this->totalViews = $data['totalViews'];
        $this->totalAnswers = $data['totalAnswer'];
        $this->adIsNotified = $data['adIsNotified'];
        $this->adIsSeen = $data['adIsSeen'];
        foreach ($data['category'] as $category) {
            $this->categories[] = Category::findOne(['_id' => $category->_id]);
        }
        foreach ($data['tags'] as $tag) {
            $this->tags[] = Tag::findOne(['_id' => $tag->_id]);
        }
        foreach ($data['labels'] as $label) {
            $this->labels[] = Label::findOne(['_id' => $label->_id]);
        }
        foreach ($data['answers'] as $answer) {
            $this->answers[] = $answer;
        }
    }
}
