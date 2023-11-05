<?php

namespace app\controllers\website;

use app\routes\http\Request;
use app\session\Session;

/**
 * LogOut Controller

 * Handles user logout from the application
 * @package app\controllers\website
 */ 
class LogOutController {

    /**
     * Logs the user out of the application
     * @param Request $request
     * @return void redirect to the index page or signin page
     */
    public static function getLogOut($request) {
        if ((Session::hasSession())) {
            Session::destroySession();
            $request->getRouter()->redirect('/signin');
        }
        $request->getRouter()->redirect('/');
    }

}
