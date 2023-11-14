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
class WappController extends AbstractPageController {

    /**
     * Return the content of app home view
     * 
     * @return string app home rendered page
     */
    public static function getWapp() {

        // Update user last action

        Session::updateUserSessionLastAction();

        // App home view

        $header = View::render('pages/webapp/html/header', [
            'userName' => Session::getCurrentUserSessionData()['name'],
            'lastName' => Session::getCurrentUserSessionData()['lastName'],
            // 'studentType' => Session::getCurrentUserSessionData()['userType'] == 1 ? '<p>Student</p>' : '',
            // 'teacherType' => Session::getCurrentUserSessionData()['userType'] == 2 ? '<p>Teacher</p>' : ' '
        ]);

        $main = View::render('pages/webapp/html/wapp/main', [
            'nickname' => Session::getCurrentUserSessionData()['nickname'],
            // 'studentType' => Session::getCurrentUserSessionData()['userType'] == 1 ? '<p>Student</p>' : '',
            // 'teacherType' => Session::getCurrentUserSessionData()['userType'] == 2 ? '<p>Teacher</p>' : ' '
        ]);

        $footer = View::render('pages/webapp/html/footer');

        // Return page view

        return parent::getPage('App', $header, $main, $footer, 
        ['css' => 'app/views/pages/style/wapp.css', 'js' => 'app/views/pages/js/dist/wapp.js']);
    }

}
