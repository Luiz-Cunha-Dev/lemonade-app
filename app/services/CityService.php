<?php 

namespace app\services;

use app\daos\CityDAO;

/**
 * City Service
 * 
 * Responsible for orchestrating business rules in the city context
 * 
 * @package app\services
 */ 
class CityService extends AbstractService {

    /**
     * City DAO
     * @var CityDAO $cityDao
     */
    private $cityDao;

    /**
     * Class constructor
     * 
     * Return a new CityService instance
     */
    public function __construct() {
        parent::__construct();
        $this->cityDao = new CityDAO($this->conn->getConnection());
    }

    /**
     * Get all cities
     * 
     * @return array $cities
     */
    public function getAllCities(){      

        $cities = $this->cityDao->getAllCities();

        $cities = array_map(function($city){
            return $city->toArray();
        }, $cities);

        $this->cityDao->closeConnection();

        return $cities;
    }

}