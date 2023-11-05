<?php 

namespace app\daos;

use app\models\CityModel;
use Exception;

/**
 * City DAO
 * 
 * Responsible for reading and writing data of city entity
 * 
 * @package app\daos
 */ 
class CityDAO extends AbstractDAO {

    /**
     * Get all cities
     * 
     * If it is null, returns an empty array
     * 
     * @return array cities
     */
    public function getAllCities(){

        try{
            $cities = parent::getAllElements('city');
             
            if(empty($cities)){
                return array();
            }

            for($i = 0; $i < count($cities); $i++){
                $cities[$i] = new CityModel($cities[$i]['idCity'], $cities[$i]['name'], $cities[$i]['uf'], $cities[$i]['idState']);
            }

            return $cities;
            
        } catch(Exception $e ) {
            throw $e;
        }
    }

}