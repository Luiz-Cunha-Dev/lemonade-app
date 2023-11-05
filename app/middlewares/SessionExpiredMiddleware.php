<?php

namespace app\middlewares;

use app\session\Session;

/**
 * Session Expires Middleware
 * 
 * If the user session has expired, redirects to the web site
 * 
 * @package app\middlewares
 */
class SessionExpiredMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Check if the user session is expired

        if (Session::checkIfSessionExpired()) {
            $request->getRouter()->redirect('/signin');
        }

       return $next($request);
    }

}
