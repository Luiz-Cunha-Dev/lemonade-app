<?php 

namespace app\controllers\website;

use app\controllers\website\WebsitePageController;
use app\views\View;
use app\services\UserService;

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
        
       // $teste = UserService::getUserById(3);
       /* UserService::insertUser([
            'name' => 'lusi',
            'lastName' => 'isul',
            'email' => 'luis@iusl',
            'nickname' => 'HHHHHHHHH',
            'password' => 'LALALLALAL',
            'salt' => '2',
            'phone' => '99999999',
            'birthDate' => '2022-03-23',
            'street' => 'rua do luis',
            'streetNumber' => '8',
            'district' => 'SP',
            'complement' => 'nao tem',
            'postalCode' => '71346',
            'firstAccess' => 0,
            'idCity' => 56,
            'idUserType' => 1
        ]);*/

        UserService::updateUserById([
            'name' => 'luis',
            'lastName' => 'isul',
            'email' => 'luis@iusl',
            'nickname' => 'HHHHHHHHH',
            'password' => 'LALALLALAL',
            'salt' => '2',
            'phone' => '99999999',
            'birthDate' => '2022-03-23',
            'street' => 'rua do luis',
            'streetNumber' => '8',
            'district' => 'SP',
            'complement' => 'nao tem',
            'postalCode' => '71346',
            'firstAccess' => 0,
            'idCity' => 56,
            'idUserType' => 1
        ], 3);

        $header = View::render('website/html/header');

        $main = View::render('website/html/teste', [
            'user' =>  empty($teste) ? 'User not found' : 'Name: ' . $teste->getName() . ' ' . $teste->getLastName(),
            
        ]);

        $footer = View::render('website/html/footer');

        // Return page view
        
        return parent::getPage('teste', $header, $main, $footer);
    }    
}
