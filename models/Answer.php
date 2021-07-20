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
            'aprovedBy' => $this->approvedBy ? $this->approvedBy->_id : null,
            'publishDate' => $this->publishDate ? new UTCDateTime($this->publishDate->getTimestamp() * 1000) : null,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
            'replies' => $this->replies,
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->content = $data['content'];
        $this->createdDate = $data['createdAt']->toDateTime();
        $this->author = User::findOne(['_id' => $data['author']]);
        $this->isApproved = $data['isApproved'];
        $this->approvedBy = $data['appovedBy'] ? User::findOne(['_id' => $data['appovedBy']]) : null;
        $this->publishDate = $data['publishDate'] ? $data['publishDate']->toDateTime() : null;
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
        foreach ($data['replies'] as $reply) {
            $this->replies[] = $reply;
        }
    }
}