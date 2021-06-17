<?php


namespace app\core\db;


use app\core\Application;
use MongoDB\BSON\ObjectId;

abstract class DbModel
{
    protected ObjectId $_id;

    public function getId(): ObjectId
    {
        return $this->_id;
    }

    abstract public static function convertToClass(array|object $data);

    abstract public static function collectionName(): string;

    public function convertToArray()
    {
        return json_decode(json_encode($this), true);
    }

    public function insertOrUpdateOne(): static|null
    {
        $collectionName = $this->collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        if ($this->_id) {
            $document = self::findOne(['_id' => $this->_id]);
            if ($document) {
                $document = $collection->updateOne(['_id' => $this->_id], $this->convertToArray());
                if (!$document) return null;
                return static::convertToClass($document);
            }
        }
        $insertedId = $collection->insertOne($this->convertToArray())->getInsertedId();
        return self::findOne(['_id' => $insertedId]);
    }

    public static function findOne($condition): static|null
    {
        $collectionName = static::collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        $document = $collection->findOne($condition);
        if (!$document) return null;
        return static::convertToClass($document);
    }
}