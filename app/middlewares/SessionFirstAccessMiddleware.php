<?php

namespace app\middlewares;

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

        // Get current user session data

        $currentUserData = Session::getCurrentUserSessionData();

        // Check if it is the user's first access

        if($currentUserData['firstAccess'] == true) {

            // Check if user is student or teacher
            
            if ($currentUserData['userType'] == 1) {

                $userService = new UserService();

                $userService->updateUserById(['firstAccess' => 0], $currentUserData['id']);

            } else {

                return new Response(200, 'text/html', 'sda'); //TODO Implement admin first access page

            }

        }

       return $next($request);
    }

}
