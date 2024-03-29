<?php


namespace app\core;


use app\core\db\DbModel;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_IN_ARRAY = 'in_array';
    public const RULE_UNIQUE = 'unique';
    public const RULE_MATCH_REGEX = 'match_regex';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function labels(): array;

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    abstract public function rules(): array;

    public function validate()
    {
        $validateRules = $this->rules();
        foreach ($validateRules as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addErrorWithRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrorWithRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addErrorWithRule($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addErrorWithRule($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                        $rule['match'] = $this->getLabel($rule['match']);
                        $this->addErrorWithRule($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_IN_ARRAY && !in_array($value, $rule['values'])) {
                    $rule['values'] = implode(', ', $rule['values']);
                    $this->addErrorWithRule($attribute, self::RULE_IN_ARRAY, $rule);
                }
                if ($ruleName === self::RULE_MATCH_REGEX && !preg_match($rule['regex'], $value)) {
                    $this->addErrorWithRule($attribute, self::RULE_MATCH_REGEX, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    /**
                     * @var $class DbModel
                     */
                    $class = $rule['class'];
                    $document = $class::findOne([$attribute => $value]);
                    if ($document) {
                        $this->addErrorWithRule($attribute, self::RULE_UNIQUE);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }

    private function addErrorWithRule(string $attribute, string $rule, $params = [])
    {
        $params['field'] ??= $this->getLabel($attribute);
        $errorMessage = $params['message'] ?? $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }

        $this->addError($attribute, $errorMessage);
    }

    public function addError(string $attribute, string $message)
    {
        $currentErrors = Application::$application->session->getFlash('error');
        if (!$currentErrors) $currentErrors = [];
        if (!isset($currentErrors[$attribute])) {
            $currentErrors[$attribute] = $message;
            Application::$application->session->setFlash('error', $currentErrors);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => '{field} is required',
            self::RULE_EMAIL => '{field} must be a valid email address',
            self::RULE_MIN => '{field} must have min length of {min}',
            self::RULE_MAX => '{field} must have max length of {max}',
            self::RULE_MATCH => '{field} must be same of {match}',
            self::RULE_IN_ARRAY => '{field} must be in [{values}]',
            self::RULE_MATCH_REGEX => '{field} must meet standard requirements',
            self::RULE_UNIQUE => '{field} already exists',
        ];
    }

    public function hasError(string $attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError(string $attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }
}