<?php 

namespace app\daos;

use app\models\StateModel;
use Exception;

/**
 * State DAO
 * 
 * Responsible for reading and writing data of state entity
 * 
 * @package app\daos
 */ 
class StateDAO extends AbstractDAO {

    /**
     * Get all states
     * 
     * If it is null, returns an empty array
     * 
     * @return array states
     */
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

        } catch(Exception $e ) {
            throw $e;
        }
    }

}