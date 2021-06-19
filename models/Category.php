<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;

class Category extends DbModel
{
    public string $name = '';
    public int $count = 0;
    public bool $isDeleted = false;

    public static function convertToClass(object|array $data)
    {
        $category = new Category();
        foreach ($data as $attr => $value) {
            switch ($attr) {
                case '_id':
                {
                    $category->_id = new ObjectId($value);
                    break;
                }
                default:
                {
                    $category->$attr = $value;
                    break;
                }
            }
        }
        return $category;
    }

    public static function collectionName(): string
    {
        return 'CATEGORIES';
    }
}