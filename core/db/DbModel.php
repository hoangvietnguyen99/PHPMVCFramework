<?php


namespace app\core\db;


use app\core\Application;
use app\core\Model;
use MongoDB\BSON\ObjectId;

abstract class DbModel extends Model
{
    protected ObjectId $_id;

    /**
     * @return ObjectId
     */
    public function getId(): ObjectId
    {
        return $this->_id;
    }

    abstract public static function collectionName(): string;

    abstract public function attributes(): array;

    /**
     * @return ObjectId
     */
    public function insertOne()
    {
        $collectionName = $this->collectionName();
        $attributes = $this->attributes();
        $collection = Application::$application->database->getCollection($collectionName);
        $data = array_combine($attributes, array_map(fn($attr) => $this->$attr, $attributes));
        $insertResult = $collection->insertOne($data);
        return $insertResult->getInsertedId();
    }

    public static function findOne($condition)
    {
        $collectionName = static::collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        $document = $collection->findOne($condition);
        if (!$document) return $document;
        $phpObject = $document->jsonSerialize();
        $model = new static();
        foreach ($phpObject as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }
}