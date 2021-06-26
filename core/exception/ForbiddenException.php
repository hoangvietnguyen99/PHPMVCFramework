<?php


namespace app\core\exception;


class ForbiddenException extends BaseException
{
    public function __construct($renderWithView = true)
    {
        parent::__construct('Forbidden', 403, $renderWithView);
    }
}