<?php

namespace app\controllers\website;

use app\controllers\AbstractPageController;
use app\views\View;

/**
 * Home controller
 * 
 * HTML file: ./views/pages/website/html/home/main.html
 * CSS file: ./views/pages/style/home.css
 * JS file: ./views/pages/js/dist/home.js
 * 
 * @package app\controllers\website
 */ 
class HomeController extends AbstractPageController {

    /**
     * Return the content of home view
     * 
     * @return string home rendered page
     */
    public static function getHome() {

        // Home view

        $header = View::render('pages/website/html/home/header');

        $main = View::render('pages/website/html/home/main');

        $footer = View::render('pages/website/html/home/footer');

        // Return page view

        return parent::getPage('Lemonade', $header, $main, $footer, 
        ['css' => './app/views/pages/style/home.css', 'js' => './app/views/pages/js/dist/home.js']);
    }

}
