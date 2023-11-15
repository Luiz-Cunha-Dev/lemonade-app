<?php

namespace app\controllers\webapp;

use app\controllers\AbstractPageController;
use app\session\Session;
use app\views\View;

/**
 * App controller
 * 
 * HTML file: ./view/pages/webapp/app.html
 * 
 * @package app\controllers\webapp
 */ 
class FirstAccessController extends AbstractPageController {

    /**
     * Return the content of app home view
     * 
     * @return string app home rendered page
     */
    public static function getFirstAccess() {

        // Update user last action

        Session::updateUserSessionLastAction();

        // App home view

        $header = View::render('pages/webapp/html/header', [
            'userName' => Session::getCurrentUserSessionData()['name'],
            'lastName' => Session::getCurrentUserSessionData()['lastName'],
            'userId' => Session::getCurrentUserSessionData()['id'],
            'profilePicture' => Session::getCurrentUserSessionData()['profilePicture']
        ]);

        $main = View::render('pages/webapp/html/firstAccess/main');

        $footer = View::render('pages/webapp/html/footer');

        // Return page view

        return parent::getPage('App', $header, $main, $footer, 
        ['css' => './app/views/pages/style/firstAccess.css', 'js' => './app/views/pages/js/dist/firstAccess.js']);
    }

}
