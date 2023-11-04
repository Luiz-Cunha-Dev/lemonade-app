<?php 

namespace app\services;

use app\DAOs\StateDAO;

/**
 * State Service
 * 
 * Responsible for orchestrating business rules in the state context
 * 
 * @package app\services
 */ 
class StateService extends Service {

    /**
     * Get all states
     * 
     * @return array $states
     */
    public function getAllStates(){

        $stateDao = new StateDAO($this->conn->getConnection());       

        $states = $stateDao->getAllStates();

        $states = array_map(function($state){
            return $state->toArray();
        }, $states);

        return $states;
    }
    
}