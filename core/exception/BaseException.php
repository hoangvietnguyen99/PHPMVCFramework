<?php


namespace app\core\exception;


use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

abstract class BaseException extends Exception
{
    /**
     * BaseException constructor.
     */
    #[Pure] public function __construct(string $message, int $code, Throwable|null $previous)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}