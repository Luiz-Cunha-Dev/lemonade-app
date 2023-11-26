<?php

namespace app\controllers\webapp;

use app\services\UserPracticeExamService;

class UserPracticeExamController{


    public static function starUserPracticeExam($request){

        $jsonVars = $request->getJsonVars();

        //print_r($jsonVars);

        $userPracticeExamService = new UserPracticeExamService;

        $idUserPracticeExam = $userPracticeExamService->startUserPracticeExam($jsonVars);

        return $idUserPracticeExam;
    }
}