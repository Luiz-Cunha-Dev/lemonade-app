<?php 

namespace  app\DAOs;

use app\models\CityModel;

class CityDao extends AbstractDao{

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


        }catch( \Exception $e ) {
            throw $e;
        }
    }
}