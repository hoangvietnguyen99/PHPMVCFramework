<?php


namespace app\core\db;


use app\core\Application;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use MongoDB\Collection;
use MongoDB\DeleteResult;
use MongoDB\InsertManyResult;
use MongoDB\InsertOneResult;
use MongoDB\UpdateResult;

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

    /**
     * @param array|object $filter
     * @param array $option
     * @return static|null
     */
    public static function findOne(array|object $filter, array $option = [])
    {
        return static::getCollection()->findOne($filter, $option);
    }

    /**
     * @param array|object $filter
     * @param array $options
     * @return static[]
     */
    public static function find(array|object $filter = [], array $options = []): array
    {
        return static::getCollection()->find($filter, $options)->toArray();
    }

    /**
     * @param array|object $filter
     * @param array $options
     * @return DeleteResult
     */
    public static function deleteOneStatic(array|object $filter, array $options = [])
    {
        return static::getCollection()->deleteOne($filter, $options);
    }

    /**
     * @param array $options
     * @return DeleteResult
     */
    public function deleteOne(array $options = [])
    {
        return static::getCollection()->deleteOne(['_id' => $this->_id], $options);
    }

    /**
     * @param array|object $filter
     * @param array $options
     * @return DeleteResult
     */
    public static function deleteManyStatic(array|object $filter, array $options = [])
    {
        return static::getCollection()->deleteMany($filter, $options);
    }

    /**
     * @param array $options
     * @return InsertOneResult
     */
    public function insertOne(array $options = [])
    {
        return static::getCollection()->insertOne($this, $options);
    }

    /**
     * @param array|object $document
     * @param array $options
     * @return InsertOneResult
     */
    public static function insertOneStatic(array|object $document, array $options = [])
    {
        return static::getCollection()->insertOne($document, $options);
    }

    /**
     * @param static[]|object[] $documents
     * @param array $options
     * @return InsertManyResult
     */
    public static function insertManyStatic(array $documents, array $options = [])
    {
        return static::getCollection()->insertMany($documents, $options);
    }

    /**
     * @param array $options
     * @return UpdateResult
     */
    public function updateOne(array $options = [])
    {
        return static::getCollection()->updateOne(['_id' => $this->_id], ['$set' => $this], $options);
    }

    /**
     * @param array|object $filter
     * @param array|object $update
     * @param array $options
     * @return UpdateResult
     */
    public static function updateOneStatic(array|object $filter, array|object $update, array $options = [])
    {
        return static::getCollection()->updateOne($filter, ['$set' => $update], $options);
    }

    /**
     * @param array|object $filter
     * @param array|object $update
     * @param array $options
     * @return static
     */
    public static function findOneAndUpdateStatic(array|object $filter, array|object $update, array $options = [])
    {
        return static::getCollection()->findOneAndUpdate($filter, ['$set' => $update], $options);
    }

    /**
     * @param array|object $filter
     * @param array|object $replacement
     * @param array $options
     * @return static|null
     */
    public static function findOneAndReplaceStatic(array|object $filter, array|object $replacement, array $options = [])
    {
        return static::getCollection()->findOneAndReplace($filter, $replacement, $options);
    }

    /**
     * @param array|object $filter
     * @param array $options
     * @return static|null
     */
    public static function findOneAndDeleteStatic(array|object $filter, array $options = [])
    {
        return static::getCollection()->findOneAndDelete($filter, $options);
    }

    /**
     * @param array|object $filter
     * @param array|object $update
     * @param array $options
     * @return UpdateResult
     */
    public static function updateManyStatic(array|object $filter, array|object $update, array $options = [])
    {
        return static::getCollection()->updateMany($filter, ['$set' => $update], $options);
    }
}
