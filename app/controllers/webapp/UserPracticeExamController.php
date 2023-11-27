<?php

namespace app\controllers\webapp;

use app\services\UserPracticeExamService;

class UserPracticeExamController{


    public static function starUserPracticeExam($request){

        $jsonVars = $request->getJsonVars();

        $userPracticeExamService = new UserPracticeExamService;

        $idUserPracticeExam = $userPracticeExamService->startUserPracticeExam($jsonVars);

        return $idUserPracticeExam;
    }

    public static function getUserPracticeExamQuestions($request){

        $jsonVars = $request->getJsonVars();
        
        $userPracticeExamService = new UserPracticeExamService;

        $userPracticeExamQuestions = $userPracticeExamService->getUserPracticeExamQuestions($jsonVars['idPracticeExam']);

        
        return $userPracticeExamQuestions;

    }
}