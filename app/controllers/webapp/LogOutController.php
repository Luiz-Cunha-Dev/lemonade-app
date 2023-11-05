<?php

namespace app\controllers\webapp;

use app\routes\http\Request;
use app\session\Session;

/**
 * LogOut Controller

 * Handles user logout from the web app
 * @package app\controllers\webapp
 */ 
class LogOutController {

    /**
     * Logs the user out of the web app
     * @param Request $request
     * @return void redirect to the index page or signin page
     */
    public static function getLogOut($request) {
        if ((Session::hasSession())) {
            Session::destroySession();
        }
        $request->getRouter()->redirect('/');
    }

}
