<?php

namespace app\controllers;

use app\views\View;

/**
 * Generic controller to handle pages (website)
 * 
 * Note, does not include web application pages, only the website
 * 
 * HTML files: ./view/pages/home.html | ./view/pages/header.html | ./view/pages/footer.html
 * 
 * @package app\controller
 * @since 0.1.0
 */ 
class PageController {

    /**
     * Return the standardized header
     * 
     * @return string header
     */
    private static function getHeader() {
        return View::render('header');
    }

    /**
     * Return the standardized footer
     * 
     * @return string footer
     */
    private static function getFooter() {
        return View::render('footer');
    }

    /**
     * Return the content of a generic page with a standardized header and footer

     * @param string $title page title
     * @param string $content page content
     * 
     * @return string rendered page
     */
    public static function getPage($title, $content) {
        return View::render('page', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }

}
