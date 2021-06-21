<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Question extends DbModel
{
    public string $title;
    public object $category;
    public string $content;
    public array $tags;
    public UTCDateTime $createdDate;
    public ObjectId $author;
    public int $totalLikes = 0;
    public int $totalDislikes = 0;

    /**
     * Question constructor.
     * @param string $title
     * @param object $category
     * @param string $content
     * @param array $tags
     * @param ObjectId $author
     */
    public function __construct(string $title, object $category, string $content, array $tags, ObjectId $author)
    {
        parent::__construct();
        $this->title = $title;
        $this->category = $category;
        $this->content = $content;
        $this->tags = $tags;
        $this->author = $author;
        $this->createdDate = new UTCDateTime(strtotime('now') * 1000);
    }


    public static function collectionName(): string
    {
        return 'QUESTIONS';
    }

    public function bsonSerialize()
    {
        return [
            '_id' => $this->_id,
            'title' => $this->title,
            'category' => $this->category,
            'content' => $this->content,
            'tags' => $this->tags,
            'createdDate' => $this->createdDate,
            'author' => $this->author,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->title = $data['title'];
        $this->category = $data['category'];
        $this->content = $data['content'];
        $this->createdDate = $data['createdDate'];
        $this->author = $data['author'];
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
        foreach ($data['tags'] as $tag) {
            $this->tags[] = $tag;
        }
    }
}