<?php


namespace app\core\exception;


class UnauthorizedException extends BaseException
{
    public function __construct($renderWithView = true)
    {
        parent::__construct('Unauthorized', 401, $renderWithView);
    }
}