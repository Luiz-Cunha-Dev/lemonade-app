<?php

namespace app\controllers\webapp;

use app\services\UserPracticeExamService;
use app\routes\http\Response;

class UserPracticeExamController{


    public static function finishUserPracticeExam($request){

        $jsonVars = $request->getJsonVars();

        $userPracticeExamService = new UserPracticeExamService;

        $insertUserPracticeExam = $userPracticeExamService->insertUserPracticeExam($jsonVars);

        if(!$insertUserPracticeExam){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível concluir a prova', 'success' => false]))->sendResponse();
        }
        return (new Response(201, 'application/json', ['message' => 'Prova concluida!', 'success' => true]))->sendResponse();
    }

    public static function getUserPracticeExamQuestions($request){

        $jsonVars = $request->getJsonVars();
        
        $userPracticeExamService = new UserPracticeExamService;

        $userPracticeExamQuestions = $userPracticeExamService->getUserPracticeExamQuestions($jsonVars['idPracticeExam']);

        
        return $userPracticeExamQuestions;

    }
}