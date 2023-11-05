<?php

namespace app\middlewares;

use app\routes\http\Request;
use app\routes\http\Response;
use Closure;

/**
 * Middleware Interface
 * 
 * Defines a standard contract for all middleware to implement
 * 
 * @package app\middlewares
 */
interface IMiddleware {

    /**
     * Handles middleware execution
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next);

}
