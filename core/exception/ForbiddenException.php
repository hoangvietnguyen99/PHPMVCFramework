<?php


namespace app\core\exception;


class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Forbidden';
}