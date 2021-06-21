<?php


namespace app\core\db;


use app\core\Application;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;

abstract class DbModel implements Persistable
{
    protected ObjectId $_id;

    /**
     * DbModel constructor.
     */
    public function __construct()
    {
        $this->_id = new ObjectId();
    }

    public function getId(): ObjectId
    {
        return $this->_id;
    }

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    abstract public static function collectionName(): string;

    public function insertOrUpdateOne($returnItem = true)
    {
        $collectionName = $this->collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        $updateResult = $collection->updateOne(['_id' => $this->getId()], ['$set' => $this], ['upsert' => true])->getUpsertedId();
        if (!$returnItem) return $updateResult;
        return self::findOne(['_id' => $updateResult]);
    }

    public static function findOne($condition)
    {
        $collectionName = static::collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        return $collection->findOne($condition);
    }

    public static function find($condition = [])
    {
        $collectionName = static::collectionName();
        $collection = Application::$application->database->getCollection($collectionName);
        $documents = $collection->find($condition);
        $results = [];
        foreach ($documents as $document) {
            $results[] = $document;
        }
        return $results;
    }
}