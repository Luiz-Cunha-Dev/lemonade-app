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
class CityService extends Service {

    /**
     * Get all cities
     * 
     * @return array $cities
     */
    public function getAllCities(){

        $cityDao = new CityDAO($this->conn->getConnection());       

        $cities = $cityDao->getAllCities();

        $cities = array_map(function($city){
            return $city->toArray();
        }, $cities);

        return $cities;
    }

}