<?php

namespace app\controllers\website;

use app\services\CityService;


class CityController extends WebsitePageController {

    public static function getCities() {

        $cityService = new CityService;

        return $cityService->getAllCities();
       
    }

}