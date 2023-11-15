<?php

namespace app\middlewares;

use app\session\Session;

/**
 * Session Refresh Middleware
 * 
 * Refresh the user session data
 * 
 * @package app\middlewares
 */
class SessionRefreshMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Refresh the user session

        Session::refreshSession(Session::getCurrentUserSessionData()['id']);

        // Continue the request

       return $next($request);
    }

}
