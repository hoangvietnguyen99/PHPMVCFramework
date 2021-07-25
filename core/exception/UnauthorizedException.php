<?php


namespace app\core\exception;


use JetBrains\PhpStorm\Pure;
use Throwable;

class UnauthorizedException extends BaseException
{
    /**
     * UnauthorizedException constructor.
     */
    #[Pure] public function __construct(Throwable $previous = null)
    {
        parent::__construct('Unauthorized', 401, $previous);
    }
}