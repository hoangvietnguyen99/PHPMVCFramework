<?php


namespace app\core;


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

    public function send(int $code, $body = null): bool|string
    {
        $this->statusCode($code);
        return json_encode($body);
    }
}