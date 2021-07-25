<?php


namespace app\core\exception;


use JetBrains\PhpStorm\Pure;
use Throwable;

class ForbiddenException extends BaseException
{
    /**
     * ForbiddenException constructor.
     */
    #[Pure] public function __construct(Throwable $previous = null)
    {
        parent::__construct('Forbidden', 403, $previous);
    }
}