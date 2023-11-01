<?php

namespace app\controllers\website;

use app\views\View;

/**
 * Home controller
 * 
 * HTML file: ./view/pages/home/home.html
 * 
 * @package app\controller
 */ 
class HomeController extends WebsitePageController {

    /**
     * Return the content of home view
     * 
     * @return string home rendered page
     */
    public static function getHome() {

        // Home view

        $header = View::render('website/html/home/header');


        $main = View::render('website/html/home/main');

        $footer = View::render('website/html/home/footer');

        // Return page view

        return parent::getPage('Lemonade', $header, $main, $footer, ['css' => 'app/views/pages/website/css/home.css']);
    }

}
