<?php


namespace app\models;


use app\core\db\DbModel;
use DateTime;
use MongoDB\BSON\UTCDateTime;

class Category extends DbModel
{
    public string $name = '';
    public int $count = 0;
    public bool $isDeleted = false;
    public DateTime $createdDate;

    public function __construct()
    {
        parent::__construct();
        $this->createdDate = new DateTime();
    }

    public static function collectionName(): string
    {
        return 'CATEGORIES';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'count' => $this->count,
            'isDeleted' => $this->isDeleted,
            'createdAt' => new UTCDateTime($this->createdDate->getTimestamp() * 1000)
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->name = $data['name'];
        $this->count = $data['count'];
        $this->isDeleted = $data['isDeleted'];
        $this->createdDate = $data['createdAt']->toDateTime();
    }
}