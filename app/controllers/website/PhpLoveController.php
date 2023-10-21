<?php

namespace app\controllers\website;

use app\views\View;

/**
 * PhpLove controller
 * 
 * HTML file: ./view/pages/phplove.html
 * 
 * @package app\controller
 */ 
class PhpLoveController extends WebsitePageController {

    /**
     * Return the content of PhpLove view
     * 
     * @return string PhpLove rendered page
     */
    public static function getPhpLove() {

        // PhpLove view

        $header = View::render('website/html/header');

        $main = View::render('website/html/phplove', [
            'h1' => 'Why love php?',
            'p' => "It's perfect for beginners but we love it because it's rounded enough to be able to handle large, complex projects. 
            The PHP framework community is extremely strong and the tools used to help you make your projects better are widely available, 
            probably better than those for Javascript, if I had to compare."
        ]);

        $footer = View::render('website/html/footer');

        // Return page view
        
        return parent::getPage('s2 PHP', $header, $main, $footer);
    }

}
