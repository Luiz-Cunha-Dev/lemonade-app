<?php

namespace app\controllers\api;

use app\services\CityService;

/**
 * City controller
 * 
 * @package app\controllers\api
 */ 
class CityController {

    /**
     * Get all cities
     * 
     * @return array $cities
     */
    public static function getCities() {

        $cityService = new CityService();

        return $cityService->getAllCities();
    }

}