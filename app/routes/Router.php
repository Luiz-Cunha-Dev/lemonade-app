<?php

namespace app\routes;

use Exception;
use http\Request;
use http\Response;

/**
 * Route manager
 * 
 * Directs and validates user requests to appropriate controllers
 * 
 * @package app\routes
 * @since 0.1.0
 */
class Router {

    /**
     * Project url (root)
     * @var string
     */
    private $url = '';

    /**
     * Global prefix
     * @var string
     */
    private $prefix = '';

    /**
     * Route collection
     * @var array
     */
    private $routes = [];

    /**
     * Route request
     * @var Request
     */
    private $request;

    /**
     * Class constructor
     * 
     * @param string $url Project url (root)
     * @return Router
     */
    public function __construct($url) {
        $this->url = $url;
        $this->request = new http\Request();
        $this->setPrefix();
    }

    /**
     * Set prefix
     */
    private function setPrefix() {
        $parseUrl = parse_url($this->url);
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Add a route to the router
     * 
     * @param string $method HTTP method
     * @param string $route route
     * @param array $params route methods
     */
    private function addRoute($method, $route, $params = []) {
        foreach($params as $key => $value) {
            if($value instanceof \Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $patternRoute = '/^' . str_replace('/', '\/',  $route) . '$/';

        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Add a GET route
     * 
     * @param string $route route
     * @param array $params route methods
     */
    public function get($route, $params = []) {
        $this->addRoute('GET', $route, $params);
    }

    /**
     * Get URI whitout prefix
     */
    private function getUri() {
        $uri = $this->request->getUri();

        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        return end($xUri);
    }

    /**
     * Get actual route
     * 
     * @return array Returns the current route
     */
    private function getRoute() {
        // URI
        $uri = $this->getUri();

        // Method
        $httpMethod = $this->request->getHttpMethod();

        // Validates the routes

        foreach($this->routes as $patternRoute => $methods) {

            // URI matches patternverif
            if(preg_match($patternRoute, $uri)) {

                // Check the method
                if(isset($methods[$httpMethod])) {

                    // Returns the route parameters
                    return $methods[$httpMethod];
                }

                throw new Exception('Method not allowed', 405);
            }

        }
        throw new Exception('Page not found', 404);
    }

    /**
     * Serve the atual route
     * 
     * @return Response Returns the controller method passed to the route
     */
    public function serve() {
        try { 
            $route = $this->getRoute();

            // Checks if the controller exists

            if(!(isset($route['controller']))) {
                throw new Exception('URL não pode ser processada', 500);
            }

            // Args

            $args = [];

            return call_user_func_array($route['controller'], $args);

        } catch (Exception $e) {
            return new http\Response($e->getCode(), 'text/html', $e->getMessage());
        }
    } 

}
