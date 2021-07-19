<?php


namespace app\models;


use app\constants\Score;
use app\core\Application;
use app\core\Model;
use app\utils\StringUtil;
use DateTime;

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
        $tags = json_decode(StringUtil::removeSpecialDoubleQuote($this->tags), true);
        $this->tags = '';
        if (!$tags) {
            $this->addError('tags', 'Invalid tags');
            return false;
        }
        $this->tags = implode(', ', array_map(fn($tag) => strtoupper($tag['value']), $tags));
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
            $item->lastUpdatedDate = new DateTime();
            $item->insertOrUpdateOne();
        }
        $user = Application::$application->user;
        $question = new Question($user);

        $question->category[] = (object) ['_id' => $category->getId(), 'name' => $category->name];
        $question->content = $this->description;
        $question->tags = array_map(fn($tag) => (object)['_id' => $tag->getId(), 'name' => $tag->name], $tagArray);
        $question->title = $this->title;

        if ($question->insertOrUpdateOne()) {
            $user->totalQuestions++;
            $user->insertOrUpdateOne();

            return true;
        }

        return false;
    }
}