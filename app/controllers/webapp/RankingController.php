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
