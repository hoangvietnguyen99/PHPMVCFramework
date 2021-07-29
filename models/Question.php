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
    /** @var ObjectId[] */
    public array $likedUserIds = [];
    /** @var ObjectId[] */
    public array $dislikedUserIds = [];
    /** @var array{_id: ObjectId, content: string} */
    public array $reports = [];

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
            'numofLiked' => count($this->likedUserIds),
            'numofDisliked' => count($this->dislikedUserIds),
            'totalViews' => $this->totalViews,
            'totalAnswer' => count($this->answers),
            'adIsNotified' => $this->adIsNotified,
            'adIsSeen' => $this->adIsSeen,
            'likedUserIds' => $this->likedUserIds,
            'dislikedUserIds' => $this->dislikedUserIds,
            'reports' => $this->reports
        ];
    }

    public function bsonUnserialize(array $data)
    {
        if ($data['_id']) $this->_id = $data['_id'];
        if ($data['title']) $this->title = $data['title'];
        if ($data['isDeleted']) $this->isDeleted = $data['isDeleted'];
        if ($data['content']) $this->content = $data['content'];
        if ($data['createdAt']) $this->createdDate = $data['createdAt']->toDateTime();
        if ($data['author']) $this->author = User::findOne(['_id' => $data['author']]);
        if ($data['approved']) $this->isApproved = $data['approved'];
        if ($data['averageRate']) $this->averageRate = $data['averageRate'];
        if ($data['appovedBy']) $this->approvedBy = $data['appovedBy'] ? User::findOne(['_id' => $data['appovedBy']]) : null;
        if ($data['publishDay']) $this->publishDate = $data['publishDay'] ? $data['publishDay']->toDateTime() : null;
        if ($data['numofLiked']) $this->totalLikes = $data['numofLiked'];
        if ($data['numofDisliked']) $this->totalDislikes = $data['numofDisliked'];
        if ($data['totalViews']) $this->totalViews = $data['totalViews'];
        if ($data['totalAnswer']) $this->totalAnswers = $data['totalAnswer'];
        if ($data['adIsNotified']) $this->adIsNotified = $data['adIsNotified'];
        if ($data['adIsSeen']) $this->adIsSeen = $data['adIsSeen'];
        if ($data['likedUserIds']) foreach ($data['likedUserIds'] as $likedUserId) {
            $this->likedUserIds[] = $likedUserId;
        }
        if ($data['dislikedUserIds']) foreach ($data['dislikedUserIds'] as $dislikedUserId) {
            $this->dislikedUserIds[] = $dislikedUserId;
        }
        if ($data['categories']) foreach ($data['categories'] as $category) {
            $this->categories[] = Category::findOne(['_id' => $category->_id]);
        }
        if ($data['tags']) foreach ($data['tags'] as $tag) {
            $this->tags[] = Tag::findOne(['_id' => $tag->_id]);
        }
        if ($data['labels']) foreach ($data['labels'] as $label) {
            $this->labels[] = Label::findOne(['_id' => $label->_id]);
        }
        if ($data['answers']) foreach ($data['answers'] as $answer) {
            $this->answers[] = $answer;
        }
        if ($data['reports']) foreach ($data['reports'] as $report) {
            $this->reports[] = $report;
        }
    }
}
