<?php


namespace app\core;


use JetBrains\PhpStorm\NoReturn;

class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($url): bool
    {
        header("Location: $url");
        return true;
    }

    #[NoReturn] public function send(int $code, $body = null)
    {
        header("Content-Type: application/json");
        $this->statusCode($code);
        echo json_encode($body);
        exit();
    }
}