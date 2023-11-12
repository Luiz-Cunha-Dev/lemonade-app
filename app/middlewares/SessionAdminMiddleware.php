<?php

namespace app\middlewares;

use app\session\Session;
use Exception;

/**
 * Session Admin Middleware
 * 
 * Checks if the user is an administrator
 * 
 * @package app\middlewares
 */
class SessionAdminMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Check if user is admin

        $isAdmin = Session::getCurrentUserSessionData()['userType'];

        if($isAdmin != 2) {
            throw new Exception('Você não possui permissão para acessar esse recurso', 403);
        }

       return $next($request);
    }

}
