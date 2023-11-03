<?php 

namespace app\services;

use app\DAOs\StateDao;

class StateService extends Service{

    public function getAllStates(){

        $stateDao = new StateDao($this->conn->getConnection());       

        $states = $stateDao->getAllStates();

        $statesJson = array();

        for($i = 0; $i < count($states); $i++){
            $statesJson[$i] = array ("idState" => $states[$i]->getIdState(), "acronym" => $states[$i]->getAcronym());
        }
        return $statesJson;
    }
    
}