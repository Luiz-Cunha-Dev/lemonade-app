<?php

namespace app\controllers\website;

use app\services\StateService;


class StateController extends WebsitePageController {

    public static function getStates() {

        $cityService = new StateService;

        return $cityService->getAllStates();
    }

}