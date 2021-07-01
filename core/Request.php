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
        $jsonData = json_decode(file_get_contents('php://input'), true);
        if ($jsonData) $this->body = json_decode(file_get_contents('php://input'), true);
//        $this->body = json_decode(file_get_contents('php://input'), true);
//        if ($rawPostBody) {
//            if (str_contains($rawPostBody, '&#34;')) $rawPostBody = str_replace('&#34;', '"', $rawPostBody);
//            $jsonParse = json_decode($rawPostBody, true);
//            if ($jsonParse) {
//                foreach ($jsonParse as $item => $value) {
//                    $this->body[$item] = $value;
//                }
//            }
//            else {
//                $tempData = [];
//                parse_str($rawPostBody, $tempData);
//                if (count($tempData)) {
//                    $this->body = array_merge($this->body, $tempData);
//                }
//            }
//        }
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
        exit;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get header Authorization
     * */
    private function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * get access token from header
     * */
    public function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}