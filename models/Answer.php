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
    public ObjectId $author;
    public bool $isApproved = false;
    public ?ObjectId $approvedBy = null;
    public ?DateTime $publishDate = null;
    public int $totalLikes = 0;
    public int $totalDislikes = 0;

    /**
     * Answer constructor.
     * @param ObjectId $author
     */
    public function __construct(ObjectId $author)
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
            'createdDate' => new UTCDateTime($this->createdDate->getTimestamp() * 1000),
            'author' => $this->author,
            'isApproved' => $this->isApproved,
            'approvedBy' => $this->approvedBy,
            'publishDate' => $this->publishDate ? new UTCDateTime($this->publishDate->getTimestamp() * 1000) : null,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->content = $data['content'];
        $this->createdDate = $data['createdDate']->toDateTime();
        $this->author = $data['author'];
        $this->isApproved = $data['isApproved'];
        $this->approvedBy = $data['approvedBy'];
        $this->publishDate = $data['publishDate'] ? $data['publishDate']->toDateTime() : null;
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
    }
}