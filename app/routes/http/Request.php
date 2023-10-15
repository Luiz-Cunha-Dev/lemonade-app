<?php

namespace app\routes\http;

/**
 * Represents an HTTP request
 * 
 * @package app\routes\http
 * @since 0.1.0
 */
class Request {

    /**
     * Request HTTP method
     * @var string
     */
    private $httpMethod;

    /**
     * Page URI
     * @var string
     */
    private $uri;

    /**
     * URL parameters ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * POST variables ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Request headers
     * @var array
     */
    private $headers = [];

    /**
     * Class constructor
     * @return Request
     */
    public function __construct() {
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
    }

    /**
     * Returns the HTTP method of the request
     * @return string
     */
    public function getHttpMethod() {
        return $this->httpMethod;
    }

    /**
     * Returns the page URI of the request
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * Returns the query parameters of the request
     * @return array
     */
    public function getQueryParams() {
        return $this->queryParams;
    }

    /**
     * Returns the POST varaibles of the request
     * @return array
     */
    public function getPostVars() {
        return $this->postVars;
    }

    /**
     * Returns the headers of the request
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

}
