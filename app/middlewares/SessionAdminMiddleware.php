<?php

namespace app\middlewares;

use app\routes\http\Response;
use app\session\Session;

/**
 * Session Logout Middleware
 * 
 * If the user is logged in, redirects to the web app
 * 
 * @package app\middlewares
 */
class SessionAdminMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Check if user is admin

        $isAdmin = Session::getCurrentUserSessionData()['userType'];

        if($isAdmin != 2) {
            return new Response(403, 'application/json', [
                'status' => 403,
                'error' => 'Forbidden',
                'message' => 'Você não possui permissão para acessar esse recurso'
            ]);
        }

       return $next($request);
    }

}
