<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;

class Question extends DbModel
{
    public string $title = '';
    public ObjectId $categoryId;
    public string $description;
    /** @var ObjectId[] $tagIds */
    public array $tagIds;

    public static function collectionName(): string
    {
        return 'QUESTIONS';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->id,
            'title' => $this->title,
            'categoryId' => $this->categoryId,
            'description' => $this->description,
            'tagIds' => $this->tagIds,
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->id = $data['_id'];
        $this->title = $data['title'];
        $this->categoryId = $data['categoryId'];
        $this->description = $data['description'];
        foreach ($data['tagIds'] as $tagId) {
            $this->tagIds[] = $tagId;
        }
    }
}