<?php

namespace app\routes\http;

/**
 * Represents an HTTP response
 * 
 * @package app\routes\http
 * @since 0.1.0
 */
class Response {

    /**
     * Response HTTP code
     * @var integer
     */
    private $httpCode;

    /**
     * Response headers
     * @var array
     */
    private $headers = [];

    /**
     * Response content type
     * @var string
     */
    private $contentType;

    /**
     * Response content
     * @var mixed 
     */
    private $content;

    /**
     * Class constructor
     * 
     * @param integer $httpCode Response HTTP code
     * @param string $contentType Response content type
     * @param mixed $content Response content
     * @return Response
     */
    public function __construct($httpCode, $contentType, $content) {
        $this->httpCode = $httpCode;
        $this->setContentType($contentType);
        $this->content = $content;
    }

    /**
     * Changes the response content type
     * 
     * @param string $contentType
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeaders('Content-Type', $contentType);
    }

    /**
     * Add headers to response
     * 
     * @param string $key
     * @param string $value
     */
    public function addHeaders($key, $value) {
        $this->headers[$key] = $value;
    } 

    /**
     * Sends headers to the browser
     */
    private function sendHeaders() {

        // HTTP status code
        http_response_code($this->httpCode);

        // HTTP headers
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Send response to user
     */
    public function sendResponse() {
        $this->sendHeaders();
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    } 

}
