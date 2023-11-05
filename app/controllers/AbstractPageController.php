<?php

namespace app\controllers;

use app\views\View;

/**
 * Generic controller to handle pages
 * 
 * HTML files: ./view/pages/page.html
 * 
 * @package app\controllers
 */ 
abstract class AbstractPageController {

    /**
     * Return the content of a generic website page
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
    final public static function getPage($title, $header, $main, $footer, $vars=[]) {
        
        $css =  array_key_exists('css', $vars) ? '<link id="css" rel="stylesheet" href="' . $vars['css'] . '">' : '';
        $js =  array_key_exists('js', $vars) ? '<script id="js"  type="module" src="' . $vars['js'] . '"></script>' : '';
         
        return View::render('page', [
            'title' => $title,
            'css' => $css,
            'header' => $header,
            'main' => $main,
            'footer' => $footer,
            'js' => $js
        ]);
    }
       
}
