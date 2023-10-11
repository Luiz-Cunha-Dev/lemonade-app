<?php

namespace app\controllers\webApp;

use app\views\View;

/**
 * Generic controller to handle pages (webapp)
 * 
 * Note, does not include website pages, only the web app
 * 
 * HTML files:
 * 
 * @package app\controller
 * @since 0.2.0
 */ 
//TODO Implement
class WebAppPageController {

    /**
     * Return the standardized header
     * 
     * @return string header
     */
    private static function getHeader() {
        //return View::render();
    }

    /**
     * Return the standardized footer
     * 
     * @return string footer
     */
    private static function getFooter() {
        //return View::render();
    }

    /**
     * Return the content of a generic page with a standardized header and footer

     * @param string $title page title
     * @param string $content page content
     * 
     * @return string rendered page
     */
    public static function getPage($title, $content) {
        /*
        return View::render('page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
        */
    }

}
