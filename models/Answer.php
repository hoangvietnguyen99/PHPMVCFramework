<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Answer extends DbModel
{
    public string $content = '';
    public DateTime $createdDate;
    public User $author;
    public bool $isApproved = false;
    public ?User $approvedBy = null;
    public ?DateTime $publishDate = null;
    public int $totalLikes = 0;
    public int $totalDislikes = 0;
    /** @var Reply[] List of reply */
    public array $replies = [];
    public bool $adIsNotified = false;
    public bool $adIsSeen = false;
    /** @var ObjectId[] */
    public array $likedUserIds = [];
    /** @var ObjectId[] */
    public array $dislikedUserIds = [];
    /** @var array{_id: ObjectId, content: string} */
    public array $reports = [];

    /**
     * Answer constructor.
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
        return 'ANSWERS';
    }

    /**
     * @inheritDoc
     */
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'content' => $this->content,
            'createdAt' => new UTCDateTime($this->createdDate->getTimestamp() * 1000),
            'author' => $this->author->_id,
            'authorName' => $this->author->name,
            'isApproved' => $this->isApproved,
            'approvedBy' => $this->approvedBy ? $this->approvedBy->_id : null,
            'publishDate' => $this->publishDate ? new UTCDateTime($this->publishDate->getTimestamp() * 1000) : null,
            'totalLikes' => count($this->likedUserIds),
            'totalDislikes' => count($this->dislikedUserIds),
            'replies' => $this->replies,
            'adIsNotified' => $this->adIsNotified,
            'adIsSeen' => $this->adIsSeen,
            'likedUserIds' => $this->likedUserIds,
            'dislikedUserIds' => $this->dislikedUserIds,
            'reports' => $this->reports
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        if (isset($data['_id'])) $this->_id = $data['_id'];
        if (isset($data['content'])) $this->content = $data['content'];
        if (isset($data['createdAt'])) $this->createdDate = $data['createdAt']->toDateTime();
        if (isset($data['author'])) $this->author = User::findOne(['_id' => $data['author']]);
        if (isset($data['isApproved'])) $this->isApproved = $data['isApproved'];
        if (isset($data['approvedBy'])) $this->approvedBy = $data['approvedBy'] ? User::findOne(['_id' => $data['approvedBy']]) : null;
        if (isset($data['publishDate'])) $this->publishDate = $data['publishDate'] ? $data['publishDate']->toDateTime() : null;
        if (isset($data['totalLikes'])) $this->totalLikes = $data['totalLikes'];
        if (isset($data['totalDislikes'])) $this->totalDislikes = $data['totalDislikes'];
        if (isset($data['adIsNotified'])) $this->adIsNotified = $data['adIsNotified'];
        if (isset($data['adIsSeen'])) $this->adIsSeen = $data['adIsSeen'];
        if (isset($data['reports'])) foreach ($data['reports'] as $report) {
            $this->reports[] = $report;
        }
        if (isset($data['likedUserIds'])) foreach ($data['likedUserIds'] as $likedUserId) {
            $this->likedUserIds[] = $likedUserId;
        }
        if (isset($data['dislikedUserIds'])) foreach ($data['dislikedUserIds'] as $dislikedUserId) {
            $this->dislikedUserIds[] = $dislikedUserId;
        }
        if (isset($data['replies'])) foreach ($data['replies'] as $reply) {
            $this->replies[] = $reply;
        }
    }
}