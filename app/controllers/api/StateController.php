<?php

namespace app\controllers\api;

use app\services\StateService;

/**
 * State controller
 * 
 * @package app\controllers\api
 */ 
class StateController {

    /**
     * Get all states
     * 
     * @return array $states
     */
    public static function getStates() {

        $cityService = new StateService();

        return $cityService->getAllStates();
    }

}