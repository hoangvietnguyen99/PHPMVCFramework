<?php


namespace app\models;


use app\core\db\DbModel;

class Category extends DbModel
{
    public string $name = '';
    public int $count = 0;
    public bool $isDeleted = false;

    public static function collectionName(): string
    {
        return 'CATEGORIES';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->id,
            'name' => $this->name,
            'count' => $this->count,
            'isDeleted' => $this->isDeleted
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->id = $data['_id'];
        $this->name = $data['name'];
        $this->count = $data['count'];
        $this->isDeleted = $data['isDeleted'];
    }
}