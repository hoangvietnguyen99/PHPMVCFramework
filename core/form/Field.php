<?php


namespace app\core\form;


use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public string $type;
    public string $label;

    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute, string $type, string $label)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
        $this->label = $label;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-group">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control%s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->label,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
}