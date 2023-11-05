<?php

namespace app\routes\middleware;

use app\routes\http\Request;
use app\routes\http\Response;
use Closure;
use Exception;

/**
 * Middleware queue
 * 
 * Manages the middleware queue
 * 
 * @package app\routes\middleware 
 */
class MiddlewareQueue {

    /**
     * Middleware map
     */
    private static $middlewareMap = [];

    /**
     * Middleware queue
     * @var array
     */
    private $middlewares = [];

    /**
     * Controller function
     * @var Closure
     */
    private $controller;

    /**
     * Controller function arguments
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Class constructor
     * @param array $middleware Middleware array
     * @param Closure $controller Controller function
     * @param array $controllerArgs Controller function arguments
     * @return MiddlewareQueue 
     */
    public function __construct($middleware, $controller, $controllerArgs) {
        $this->middlewares = $middleware;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Set middleware map
     * @param array $middlewareMap alias => class
     */
    public static function setMiddlewareMap($middlewareMap) {
        self::$middlewareMap = $middlewareMap;
    }

    /**
     * Returns the next member of the queue
     * @param Request $request
     * @return Response
     */
    public function next($request) {

        // Is queue empty?

        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs); // Return controller

        $middleware = array_shift($this->middlewares); // Get first middleware

        // Check middleware map

        if(!(isset(self::$middlewareMap[$middleware]))) {
            throw new Exception("Internal Server Error", 500);
        }

        $middlewareClass = self::$middlewareMap[$middleware];

        // Next

        $middlewareQueue = $this;

        $next = function($request) use ($middlewareQueue) {
            return $middlewareQueue->next($request);
        };

        // Runs the middleware

        return (new self::$middlewareMap[$middleware])->handle($request, $next);
    
    }
    



}