<?php 

namespace app\controllers\website;

use app\controllers\website\WebsitePageController;
use app\views\View;
use app\models\UserModel;

class TesteController extends WebsitePageController{

    public static function getTeste() {
        
        $teste = UserModel::getUserById(1);

        $header = View::render('website/html/header');

        $main = View::render('website/html/teste', [
            'users' =>  $teste['name'], $teste['street']
        ]);

        $footer = View::render('website/html/footer');

        // Return page view
        
        return parent::getPage('teste', $header, $main, $footer);
    } 
}