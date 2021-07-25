<?php


namespace app\core\exception;


use JetBrains\PhpStorm\Pure;
use Throwable;

class BadRequestException extends BaseException
{
    /**
     * BadRequestException constructor.
     */
    #[Pure] public function __construct(Throwable $previous = null)
    {
        parent::__construct('Bad request', 400, $previous);
    }
}