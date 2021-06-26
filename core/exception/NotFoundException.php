<?php


namespace app\core\exception;


class NotFoundException extends BaseException
{
    public function __construct($renderWithView = true)
    {
        parent::__construct('Not found', 404, $renderWithView);
    }
}