<?php

namespace app\controllers\webapp;

use app\controllers\AbstractPageController;
use app\session\Session;
use app\views\View;

/**
 * Ranking controller
 * 
 * HTML file: ./view/pages/webapp/ranking/main.html
 * CSS file: ./views/pages/style/ranking.css
 * JS file: ./views/pages/js/dist/ranking.js
 * 
 * @package app\controllers\webapp
 */ 
class RankingController extends AbstractPageController {

    private static function getStudentSidebarItems() {

        $item1 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/ranking',
            'imageUrl' => './app/views/pages/assets/svgs/ranking.svg',
            'itemName' => 'Ranking'
        ]);

        $item2 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/exams',
            'imageUrl' => './app/views/pages/assets/svgs/exam.svg',
            'itemName' => 'Simulados'
        ]);

        $item3 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/train',
            'imageUrl' => './app/views/pages/assets/svgs/target.svg',
            'itemName' => 'Treinar'
        ]);

        return $item1 . $item2 . $item3;
    }

    private static function getAdminSidebarItems() {
        
        $item1 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/ranking',
            'imageUrl' => './app/views/pages/assets/svgs/ranking.svg',
            'itemName' => 'Ranking'
        ]);

        $item2 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/createExam',
            'imageUrl' => './app/views/pages/assets/svgs/exam.svg',
            'itemName' => 'Simulados'
        ]);

        $item3 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/users',
            'imageUrl' => './app/views/pages/assets/svgs/users.svg',
            'itemName' => 'Usuários'
        ]);

        $item4 = View::render('pages/components/sidebarItem', [
            'itemUrl' => 'wapp/createQuestion',
            'imageUrl' => './app/views/pages/assets/svgs/book.svg',
            'itemName' => 'Questões'
        ]);

        return $item1 . $item2 . $item3 . $item4;
    }

    /**
     * Return the content of app ranking view
     * 
     * @return string app ranking rendered page
     */
    public static function getRanking() {

        // App Ranking view

        $header = View::render('pages/webapp/html/header', [
            'userName' => Session::getCurrentUserSessionData()['name'],
            'lastName' => Session::getCurrentUserSessionData()['lastName'],
            'sidebarItems' => Session::getCurrentUserSessionData()['userType'] == 1 ? self::getStudentSidebarItems() : self::getAdminSidebarItems(),
            'profilePicture' => Session::getCurrentUserSessionData()['profilePicture'],
            'userId' => Session::getCurrentUserSessionData()['id'],
        ]);

        $main = View::render('pages/webapp/html/ranking/main', [
            'nickname' => Session::getCurrentUserSessionData()['nickname'],
        ]);

        $footer = View::render('pages/webapp/html/footer');

        // Return page view

        return parent::getPage('App', $header, $main, $footer, 
        ['css' => './app/views/pages/style/ranking.css', 'js' => './app/views/pages/js/dist/ranking.js']);
    }

}
