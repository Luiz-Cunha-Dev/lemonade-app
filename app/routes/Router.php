<?php

namespace app\routes;

use \Exception;
use \Closure;
use \ReflectionFunction;
use http\Request;
use http\Response;

/**
 * Route manager
 * 
 * Directs and validates user requests to appropriate controllers
 * 
 * @package app\routes
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

            if($value instanceof Closure) {

                $params['controller'] = $value;
                unset($params[$key]);
                continue;

            }

        }

        // Route variables

        $params['variables'] = [];

        // Variables pattern

        $patternVariables = '/{(.*?)}/';

        // Verify if the route has variables and add to the params array

        if(preg_match_all($patternVariables, $route, $matches)) {
            $route = preg_replace($patternVariables, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        // URL pattern

        $patternRoute = '/^' . str_replace('/', '\/',  $route) . '$/';

        // Add route to collection

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
     * Add a POST route
     * 
     * @param string $route route
     * @param array $params route methods
     */
    public function post($route, $params = []) {
        $this->addRoute('POST', $route, $params);
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

            // URI matches pattern verify

            if(preg_match($patternRoute, $uri, $matches)) {

                // Check the method

                if(isset($methods[$httpMethod])) {

                    // Remove the first element of the array (the entire route)

                    unset($matches[0]);

                    // Add variables and request to the route parameters

                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

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
                throw new Exception('Internal Server Error', 500);
            }

            // Args

            $args = [];

            // Reflection

            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            // Returns the execution of the controller function

            return call_user_func_array($route['controller'], $args);

        } catch (Exception $e) {

            return new http\Response($e->getCode(), 'text/html', $e->getMessage());
            
        }
    } 

}
