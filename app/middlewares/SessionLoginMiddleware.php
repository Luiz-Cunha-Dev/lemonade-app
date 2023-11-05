<?php

namespace app\middlewares;

use app\session\Session;

/**
 * Session Logout Middleware
 * 
 * If the user is not logged in, redirects to the web site
 * 
 * @package app\middlewares
 */
class SessionLoginMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Check if user is logged

        if(!(Session::hasSession())) {
            $request->getRouter()->redirect('/signin');
        }

       return $next($request);
    }

}
