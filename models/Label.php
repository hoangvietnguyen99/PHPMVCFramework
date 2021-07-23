<?php


namespace app\models;


use app\core\db\DbModel;

class Label extends DbModel
{
    public string $name = '';

    public static function collectionName(): string
    {
        return 'LABELS';
    }

    /**
     * @inheritDoc
     */
    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'name' => $this->name
        ];
    }

    /**
     * @inheritDoc
     */
    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->name = $data['name'];
    }
}