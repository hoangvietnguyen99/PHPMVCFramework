<?php


namespace app\core\db;


use app\core\Application;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use MongoDB\Collection;

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

    public static function getCollection(): Collection
    {
        $collectionName = static::collectionName();
        return Application::$application->database->getCollection($collectionName);
    }

    abstract public static function collectionName(): string;

    public function insertOrUpdateOne($returnItem = true, $options = [])
    {
        $collection = $this->getCollection();
        $options['upsert'] = true;
        $updateResult = $collection->updateOne(['_id' => $this->getId()], ['$set' => $this], $options)->getUpsertedId() ?? $this->getId();
        if (!$returnItem) return $updateResult;
        return static::findOne(['_id' => $updateResult]);
    }

    public static function findOne($filter = [], $option = [])
    {
        $collection = static::getCollection();
        return $collection->findOne($filter, $option);
    }

    public static function find($filter = [], $options = []): array
    {
        $collection = static::getCollection();
        $documents = $collection->find($filter, $options);
        $results = [];
        foreach ($documents as $document) {
            $results[] = $document;
        }
        return $results;
    }

    public static function deleteOne(array | object $filter, $options = []): int
    {
        $collection = static::getCollection();
        $result = $collection->deleteOne($filter, $options);
        return $result->getDeletedCount();
    }
}
