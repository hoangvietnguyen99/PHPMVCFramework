<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\UTCDateTime;

class Tag extends DbModel
{
    public string $name = '';
    public int $count = 0;
    public bool $isDeleted = false;
    public ?DateTime $createdDate;
    public ?DateTime $lastUpdatedDate = null;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->createdDate = new DateTime();
    }


    public static function collectionName(): string
    {
        return 'TAGS';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'count' => $this->count,
            'isDeleted' => $this->isDeleted,
            'createdAt' => new UTCDateTime($this->createdDate->getTimestamp() * 1000),
            'updatedAt' => $this->lastUpdatedDate ? new UTCDateTime($this->lastUpdatedDate->getTimestamp() * 1000) : null
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->name = $data['name'];
        $this->count = $data['count'];
        $this->isDeleted = $data['isDeleted'];
        $this->createdDate = $data['createdAt'] ? $data['createdAt']->toDateTime() : null;
        $this->lastUpdatedDate = $data['updatedAt'] ? $data['updatedAt']->toDateTime() : null;
    }
}
