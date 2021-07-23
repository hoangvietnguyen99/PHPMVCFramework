<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Reply extends DbModel
{
    public string $content = '';
    public DateTime $createdDate;
    public User $author;

    /**
     * Reply constructor.
     * @param User $author
     */
    public function __construct(User $author)
    {
        $this->author = $author;
        parent::__construct();
        $this->createdDate = new DateTime();
    }

    public static function collectionName(): string
    {
        return 'REPLIES';
    }

    /**
     * @inheritDoc
     */
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'createdDate' => new UTCDateTime($this->createdDate->getTimestamp() * 1000),
            'author' => $this->author->_id,
            'content' => $this->content
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->createdDate = $data['createdDate']->toDateTime();
        $this->author = User::findOne(['_id' => $data['author']]);
        $this->content = $data['content'];
    }
}