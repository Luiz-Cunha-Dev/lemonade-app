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

        if (!(isset($request->getHeaders()['ltoken']))) {
            return new Response(401, 'application/json', [
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Insira um token válido'
            ]);
        }

        if ($request->getHeaders()['ltoken'] != $_ENV['INTERNAL_API_TOKEN']) {
            return new Response(401, 'application/json', [
                'status' => 401,
                'error' => 'Unauthorized',
                'message' => 'Token inválido'
            ]);
        }

       return $next($request);
    }

}
