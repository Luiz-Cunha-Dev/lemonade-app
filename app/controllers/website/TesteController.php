<?php 

namespace app\controllers\website;

use app\controllers\website\WebsitePageController;
use app\views\View;
use app\models\UserModel;

/**
 * Teste controller
 * 
 * HTML file: ./view/pages/teste.html
 * 
 * @package app\controller
 */ 
class TesteController extends WebsitePageController{

    /**
     * Return the content of teste view
     * 
     * @return string teste rendered page
     */
    public static function getTeste() {
        
        $teste = UserModel::getUserById(1);

        $header = View::render('website/html/header');

        $main = View::render('website/html/teste', [
            'user' =>  empty($teste['name']) ? 'User not found' : 'Name: ' . $teste['name']
        ]);

        $footer = View::render('website/html/footer');

        // Return page view
        
        return parent::getPage('teste', $header, $main, $footer);
    } 
    
}
