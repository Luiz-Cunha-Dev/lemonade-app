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
class AppController extends AbstractPageController {

    /**
     * Return the content of app home view
     * 
     * @return string app home rendered page
     */
    public static function getApp() {

        // Update user last action

        Session::updateUserSessionLastAction();

        // App home view

        $header = null;

        $main = View::render('webapp/html/app', [
            'userName' => Session::getCurrentUserSessionData()['name'],
            'studentType' => Session::getCurrentUserSessionData()['userType'] == 1 ? '<p>Student</p>' : '',
            'teacherType' => Session::getCurrentUserSessionData()['userType'] == 2 ? '<p>Teacher</p>' : ' '
        ]);

        $footer = null;

        // Return page view

        return parent::getPage('App', $header, $main, $footer);
    }

}
