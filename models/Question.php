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
            'categories' => array_map(fn($item) => [
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
        if (isset($data['_id'])) $this->_id = $data['_id'];
        if (isset($data['title'])) $this->title = $data['title'];
        if (isset($data['isDeleted'])) $this->isDeleted = $data['isDeleted'];
        if (isset($data['content'])) $this->content = $data['content'];
        if (isset($data['createdAt'])) $this->createdDate = $data['createdAt']->toDateTime();
        if (isset($data['author'])) $this->author = User::findOne(['_id' => $data['author']]);
        if (isset($data['approved'])) $this->isApproved = $data['approved'];
        if (isset($data['averageRate'])) $this->averageRate = $data['averageRate'];
        if (isset($data['appovedBy'])) $this->approvedBy = $data['appovedBy'] ? User::findOne(['_id' => $data['appovedBy']]) : null;
        if (isset($data['publishDay'])) $this->publishDate = $data['publishDay'] ? $data['publishDay']->toDateTime() : null;
        if (isset($data['numofLiked'])) $this->totalLikes = $data['numofLiked'];
        if (isset($data['numofDisliked'])) $this->totalDislikes = $data['numofDisliked'];
        if (isset($data['totalViews'])) $this->totalViews = $data['totalViews'];
        if (isset($data['totalAnswer'])) $this->totalAnswers = $data['totalAnswer'];
        if (isset($data['adIsNotified'])) $this->adIsNotified = $data['adIsNotified'];
        if (isset($data['adIsSeen'])) $this->adIsSeen = $data['adIsSeen'];
        if (isset($data['categories'])) foreach ($data['categories'] as $category) {
            $this->categories[] = Category::findOne(['_id' => $category->_id]);
        }
        if (isset($data['tags'])) foreach ($data['tags'] as $tag) {
            $this->tags[] = Tag::findOne(['_id' => $tag->_id]);
        }
        if (isset($data['labels'])) foreach ($data['labels'] as $label) {
            $this->labels[] = Label::findOne(['_id' => $label->_id]);
        }
        if (isset($data['answers'])) foreach ($data['answers'] as $answer) {
            $this->answers[] = $answer;
        }
    }
}
