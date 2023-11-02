<?php 

namespace  app\DAOs;

use app\models\StateModel;

class StateDao extends AbstractDao{

    public function getAllStates(){

        try{
            $states = parent::getAllElements('state');
             
            if(empty($states)){
                return array();
            }

            for($i = 0; $i < count($states); $i++){
                $states[$i] = new StateModel($states[$i]['idState'], $states[$i]['name'], $states[$i]['acronym']);
            }

            return $states;


        }catch( \Exception $e ) {
            throw $e;
        }
    }
}