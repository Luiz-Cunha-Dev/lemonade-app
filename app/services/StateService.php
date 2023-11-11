<?php 

namespace app\services;

use app\daos\StateDAO;

/**
 * State Service
 * 
 * Responsible for orchestrating business rules in the state context
 * 
 * @package app\services
 */ 
class StateService extends AbstractService {

    /**
     * State DAO
     * @var StateDAO $stateDao
     */
    private $stateDao;


    /**
     * Class constructor
     * 
     * Return a new StateService instance
     */
    public function __construct() {
        parent::__construct();
        $this->stateDao = new StateDAO($this->conn->getConnection());
    }

    /**
     * Get all states
     * 
     * @return array $states
     */
    public function getAllStates(){     

        $states = $this->stateDao->getAllStates();

        $states = array_map(function($state){
            return $state->toArray();
        }, $states);

        $this->stateDao->closeConnection();

        return $states;
    }
    
}