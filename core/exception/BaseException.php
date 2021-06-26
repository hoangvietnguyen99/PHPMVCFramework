<?php


namespace app\core\exception;


use Exception;

abstract class BaseException extends Exception
{
    public bool $renderWithView;

    public function __construct($message = "", $code = 0, $renderWithView = true)
    {
        parent::__construct($message, $code);
        $this->renderWithView = $renderWithView;
    }
}