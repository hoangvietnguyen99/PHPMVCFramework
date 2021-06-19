<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;

class Tag extends DbModel
{
    public string $name = '';
    public int $count = 0;
    public bool $isDeleted = false;

    public static function convertToClass(object|array $data)
    {
        $tag = new Tag();
        foreach ($data as $attr => $value) {
            switch ($attr) {
                case '_id':
                {
                    $tag->_id = new ObjectId($value);
                    break;
                }
                default:
                {
                    $tag->$attr = $value;
                    break;
                }
            }
        }
        return $tag;
    }

    public static function collectionName(): string
    {
        return 'TAGS';
    }
}