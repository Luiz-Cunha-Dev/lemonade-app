<?php

namespace app\middlewares;

use app\routes\http\Response;

/**
 * Internal Api Token Middleware
 * 
 * Authentication for using internal APIs
 * 
 * @package app\middlewares
 */
class InternalApiTokenMiddleware implements IMiddleware {

    public function handle($request, $next) {

        if (!(isset($request->getQueryParams()['inApiToken']))) {
            return new Response(401, 'application/json', [
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Internal API Token is required'
            ]);
        }

        if ($request->getQueryParams()['inApiToken'] != $_ENV['INTERNAL_API_TOKEN']) {
            return new Response(401, 'application/json', [
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Invalid Internal API Token'
            ]);
        }

       return $next($request);
    }

}
