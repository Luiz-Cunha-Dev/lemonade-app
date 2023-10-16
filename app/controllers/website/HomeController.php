<?php

namespace app\controllers\website;

use app\views\View;

/**
 * Home controller
 * 
 * HTML file: ./view/pages/home.html
 * 
 * @package app\controller
 * @since 0.1.0
 */ 
class HomeController extends WebsitePageController {

    /**
     * Return the content of home view
     * 
     * @return string home rendered page
     */
    public static function getHome() {

        // Home view
        $pageContent = View::render('website/home', []);

        // Return page view
        return parent::getPage('Home', $pageContent);
    }

}
