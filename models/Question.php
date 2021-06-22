<?php


namespace app\models;


use app\core\db\DbModel;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class Question extends DbModel
{
    public string $title = '';
    public string $content = '';
    public UTCDateTime $createdDate;
    public ObjectId $author;
    public bool $isApproved = false;
    public ?ObjectId $approvedBy = null;
    public ?UTCDateTime $publishDate = null;
    public array $category = [];
    public array $tags = [];
    public array $labels = [];
    /** @var Answer[] $answers */
    public array $answers = [];
    public int $totalLikes = 0;
    public int $totalDislikes = 0;
    public int $totalViews = 0;

    /**
     * Question constructor.
     * @param ObjectId $author
     */
    public function __construct(ObjectId $author)
    {
        parent::__construct();
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
            'content' => $this->content,
            'createdDate' => $this->createdDate,
            'author' => $this->author,
            'isApproved' => $this->isApproved,
            'approvedBy' => $this->approvedBy,
            'publishDate' => $this->publishDate,
            'category' => $this->category,
            'tags' => $this->tags,
            'labels' => $this->labels,
            'answers' => $this->answers,
            'totalLikes' => $this->totalLikes,
            'totalDislikes' => $this->totalDislikes,
            'totalViews' => $this->totalViews,
        ];
    }

    public function bsonUnserialize(array $data)
    {
        $this->_id = $data['_id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->createdDate = $data['createdDate'];
        $this->author = $data['author'];
        $this->isApproved = $data['isApproved'];
        $this->approvedBy = $data['approvedBy'];
        $this->publishDate = $data['publishDate'];
        $this->totalLikes = $data['totalLikes'];
        $this->totalDislikes = $data['totalDislikes'];
        $this->totalViews = $data['totalViews'];
        foreach ($data['category'] as $category) {
            $this->category[] = $category;
        }
        foreach ($data['tags'] as $tag) {
            $this->tags[] = $tag;
        }
        foreach ($data['labels'] as $label) {
            $this->labels[] = $label;
        }
        foreach ($data['answers'] as $answer) {
            $this->answers[] = $answer;
        }
    }
}