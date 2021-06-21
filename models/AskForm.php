<?php


namespace app\models;


use app\core\Model;
use app\utils\Util;
use function MongoDB\BSON\fromPHP;
use function MongoDB\BSON\toPHP;

class AskForm extends Model
{
    public string $title = '';
    public string $category = '';
    public string $description = '';
    public string $tags = '';

    public function labels(): array
    {
        return [
            'title' => 'Title',
            'category' => 'Category',
            'description' => 'Description',
            'tags' => 'Tags',
        ];
    }

    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'category' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'tags' => [self::RULE_REQUIRED],
        ];
    }

    public function ask()
    {
        if (str_contains($this->tags, '&#34;')) {
            $this->tags = str_replace('&#34;', '"', $this->tags);
        }
        $tags = json_decode($this->tags, true);
        $this->tags = '';
        if (!$tags) {
            $this->addError('tags', 'Invalid tags');
            return false;
        }
        $this->tags = implode(', ', array_map(fn($tag) => $tag['name'], $tags));
        $tagArray = [];
        foreach ($tags as $tag) {
            $tagInDb = Tag::findOne(["name" => $tag['value']]);
            if (!$tagInDb) {
                $tagInDb = new Tag();
                $tagInDb->name = $tag['value'];
            }
            $tagArray[] = $tagInDb;
        }
        $category = Category::findOne(["name" => $this->category]);
        if (!$category) {
            $this->addError('category', 'Category not found.');
            return false;
        }
        $category->count++;
        $category->insertOrUpdateOne();
        foreach ($tagArray as $item) {
            $item->count++;
            $item->insertOrUpdateOne();
        }
        $question = new Question();
        $question->categoryId = $category->getId();
        $question->tagIds = array_map(fn($tag) => $tag->getId(), $tagArray);
        $question->title = $this->title;
        $question->description = $this->description;
        if ($question->insertOrUpdateOne()) {
            return true;
        }
        return false;
    }
}