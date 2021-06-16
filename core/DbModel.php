<?php


namespace app\core;


use function MongoDB\BSON\toPHP;

abstract class DbModel extends Model
{
    abstract public static function collectionName(): string;

    abstract public function attributes(): array;

    public static function primaryKey(): string
    {
        return '_id';
    }

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