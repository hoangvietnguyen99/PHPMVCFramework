<?php


namespace app\core;

/**
 * Class Request
 * @package app\core
 */
class Request
{
    public array $query = [];
    public string $url;
    public string $fullUrl;
    public array $body = [];
    public array $path;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->fullUrl = $_SERVER['REQUEST_URI'];
        $this->url = $_SERVER['REQUEST_URI'];
        $position = strpos($this->fullUrl, '?');
        if ($position !== false) {
            $this->url = substr($this->fullUrl, 0, $position);
        }
        $this->path = explode('/', substr($this->url, 1));
        foreach ($_GET as $key => $value) {
            $this->query[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        foreach ($_POST as $key => $value) {
            $this->body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $rawPostBody = file_get_contents('php://input');
        $postData = json_decode($rawPostBody, true);
        if ($postData) {
            foreach ($postData as $key => $value) {
                $this->body[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}