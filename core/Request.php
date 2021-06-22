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
        if ($rawPostBody) {
            if (str_contains($rawPostBody, '&#34;')) $rawPostBody = str_replace('&#34;', '"', $rawPostBody);
            $jsonParse = json_decode($rawPostBody, true);
            if ($jsonParse) {
                foreach ($jsonParse as $item => $value) {
                    $this->body[$item] = $value;
                }
            }
            else {
                $tempData = [];
                parse_str($rawPostBody, $tempData);
                if (count($tempData)) {
                    $this->body = array_merge($this->body, $tempData);
                }
            }
        }

    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}