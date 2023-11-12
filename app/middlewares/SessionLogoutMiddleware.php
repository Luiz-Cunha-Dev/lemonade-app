<?php

namespace app\middlewares;

use app\session\Session;

/**
 * Session Logout Middleware
 * 
 * If the user is logged in, redirects to the web app
 * 
 * @package app\middlewares
 */
class SessionLogoutMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Check if user is logged

        if(Session::hasSession()) {
            $request->getRouter()->redirect('/wapp'); //TODO implement webapp root route
        }

       return $next($request);
    }

}
