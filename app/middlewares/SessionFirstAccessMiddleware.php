<?php

namespace app\middlewares;

use app\controllers\webapp\FirstAccessController;
use app\routes\http\Response;
use app\services\UserService;
use app\session\Session;

/**
 * Session Logout Middleware
 * 
 * Check if it is the user's first access
 * 
 * @package app\middlewares
 */
class SessionFirstAccessMiddleware implements IMiddleware {

    public function handle($request, $next) {

        // Refresh session

        Session::refreshSession(Session::getCurrentUserSessionData()['id']);

        // Get current user session data

        $currentUserData = Session::getCurrentUserSessionData();

        // Check if it is the user's first access

        if($currentUserData['firstAccess'] == 1) {

            // Check if user is student or teacher
            
            if ($currentUserData['userType'] == 1) {

                $userService = new UserService();

                $userService->updateUserById(['firstAccess' => 0], $currentUserData['id']);

            } else {

                return new Response(200, 'text/html', FirstAccessController::getFirstAccess());

            }

        }

       return $next($request);
    }

}
