<?php


namespace app\core\exception;


use JetBrains\PhpStorm\Pure;
use Throwable;

class NotFoundException extends BaseException
{
    /**
     * NotFoundException constructor.
     */
    #[Pure] public function __construct(Throwable $previous = null)
    {
        parent::__construct('Not found', 404, $previous);
    }
}