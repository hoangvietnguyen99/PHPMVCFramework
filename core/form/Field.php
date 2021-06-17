<?php


namespace app\core\form;


use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public string $inputHtml;

    public function __construct(Model $model, string $inputHtml, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $inputHtml = str_replace('{{name}}', $attribute, $inputHtml);
        $inputHtml = str_replace('{{value}}', $this->model->{$this->attribute}, $inputHtml);
        $this->inputHtml = str_replace('{{label}}', $this->model->getLabel($this->attribute), $inputHtml);
    }

    public function __toString(): string
    {
        return sprintf('%s',
            $this->inputHtml
        );
    }


}