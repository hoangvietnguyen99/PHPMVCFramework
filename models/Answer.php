<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Answer extends DbModel
{
    public string $content = '';
    public UTCDateTime $createdDate;
    public ObjectId $author;
    public bool $isApproved = false;
    public ?ObjectId $approvedBy = null;
    public ?UTCDateTime $publishDate = null;
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
        $this->createdDate = new UTCDateTime(strtotime('now') * 1000);
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
            'createdDate' => $this->createdDate,
            'author' => $this->author,
            'isApproved' => $this->isApproved,
            'approvedBy' => $this->approvedBy,
            'publishDate' => $this->publishDate,
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
        $this->createdDate = $data['createdDate'];
        $this->author = $data['author'];
        $this->isApproved = $data['isApproved'];
        $this->approvedBy = $data['approvedBy'];
        $this->publishDate = $data['publishDate'];
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
    }
}