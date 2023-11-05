<?php

namespace app\controllers\website;

use app\controllers\AbstractPageController;
use app\views\View;

/**
 * SignUp controller
 * 
 * HTML file: ./view/pages/website/html/auth/signUp.html
 * CSS file: ./view/pages/website/css/signUp.css
 * JS file: ./view/pages/website/js/signUp.js
 * 
 * @package app\controllers\website
 */ 
class SignUpController extends AbstractPageController {

    /**
     * Return the content of sign up view
     * 
     * @return string sign up rendered page
     */
    public static function getSignUp() {

        // SignUp view

        $header = View::render('website/html/auth/header');

        $main = View::render('website/html/auth/signUp');

        $footer = View::render('website/html/auth/footer');

        // Return page view
        
        return parent::getPage('Cadastrar-se no Lemonade', $header, $main, $footer, 
        ['css' => 'app/views/pages/website/css/signUpDark.css', 'js' => 'app/views/pages/website/js/dist/signUp.js']);
    }

}
