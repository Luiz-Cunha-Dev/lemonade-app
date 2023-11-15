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
class WappController extends AbstractPageController
{

    public static function getStudentSidebarItems() {

        $item1 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/ranking',
            'imageUrl' => 'app/views/pages/assets/svgs/ranking.svg',
            'itemName' => 'Ranking'
        ]);

        $item2 = View::render('pages/components/sidebarItem', [
            'itemUrl' => '#',
            'imageUrl' => 'app/views/pages/assets/svgs/exam.svg',
            'itemName' => 'Simulados'
        ]);

        $item3 = View::render('pages/components/sidebarItem', [
            'itemUrl' => '#',
            'imageUrl' => 'app/views/pages/assets/svgs/target.svg',
            'itemName' => 'Treinar'
        ]);

        return $item1 . $item2 . $item3;
    }

    public static function getAdminSidebarItems() {
        
        $item1 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/ranking',
            'imageUrl' => 'app/views/pages/assets/svgs/ranking.svg',
            'itemName' => 'Ranking'
        ]);

        $item2 = View::render('pages/components/sidebarItem', [
            'itemUrl' => '#',
            'imageUrl' => 'app/views/pages/assets/svgs/exam.svg',
            'itemName' => 'Simulados'
        ]);

        $item3 = View::render('pages/components/sidebarItem', [
            'itemUrl' => '#',
            'imageUrl' => 'app/views/pages/assets/svgs/users.svg',
            'itemName' => 'Usuários'
        ]);

        $item4 = View::render('pages/components/sidebarItem', [
            'itemUrl' => '#',
            'imageUrl' => 'app/views/pages/assets/svgs/book.svg',
            'itemName' => 'Questões'
        ]);

        return $item1 . $item2 . $item3 . $item4;
    }

    /**
     * Return the content of app home view
     * 
     * @return string app home rendered page
     */
    public static function getWapp()
    {

        // Update user last action

        Session::updateUserSessionLastAction();

        // App home view

        $header = View::render('pages/webapp/html/header', [
            'userName' => Session::getCurrentUserSessionData()['name'],
            'lastName' => Session::getCurrentUserSessionData()['lastName'],
            'sidebarItems' => Session::getCurrentUserSessionData()['userType'] == 1 ? self::getStudentSidebarItems() : self::getAdminSidebarItems()
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

        return parent::getPage(
            'App',
            $header,
            $main,
            $footer,
            ['css' => 'app/views/pages/style/wapp.css', 'js' => 'app/views/pages/js/dist/wapp.js']
        );
    }
}
