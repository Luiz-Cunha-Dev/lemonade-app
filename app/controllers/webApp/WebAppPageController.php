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
 */ 
//TODO Implement
class WebAppPageController {

    
    /**
     * Return the content of a generic webapp page
     *
     * Using $vars: 'css' => your css | 'js' => your javascript
     * 
     * @param string $title page title
     * @param string $header page header
     * @param string $main page main
     * @param string $footer page footer
     * @param array $vars page css and javascript(module)
     * 
     * @return string rendered page
     */
    /*
    public static function getPage($title, $header, $main, $footer, $vars=[]) {
        
        $css =  array_key_exists('css', $vars) ? '<link rel="stylesheet" href="' . $vars['css'] . '">' : '';
        $js =  array_key_exists('js', $vars) ? '<script type="module" src="' . $vars['js'] . '"></script>' : '';
         
        return View::render('website/page', [
            'title' => $title,
            'css' => $css,
            'header' => $header,
            'main' => $main,
            'footer' => $footer,
            'js' => $js
        ]);
    }
    */
}
