<?php 

namespace app\services;

use app\models\CityModel;
use app\DAOs\CityDao;

class CityService extends Service{

    public function getAllCities(){

        $cityDao = new CityDao($this->conn->getConnection());       

        $cities = $cityDao->getAllCities();

        for($i = 0; $i < count($cities); $i++){
            $citiesJson[$i] = array ("idCity" => $cities[$i]->getIdCity(), "name" => $cities[$i]->getName());
        }
        
        return $citiesJson;
    }

    
}