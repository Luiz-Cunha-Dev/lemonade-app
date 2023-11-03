<?php

namespace app\controllers\api;

use app\services\StateService;

/**
 * State controller
 * 
 * @package app\controllers\api
 */ 
class StateController {

    public static function getStates() {

        $cityService = new StateService();

        return $cityService->getAllStates();
    }

}