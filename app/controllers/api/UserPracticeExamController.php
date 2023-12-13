<?php

namespace app\controllers\api;

use app\services\UserPracticeExamService;
use app\routes\http\Response;

/**
 * User PracticeExamController
 * 
 * @package app\controllers\api
 */ 
class UserPracticeExamController{

    /**
     * Get all user practice exams
     * 
     * @param integer idUserPracticeExam
     * 
     * @return array $userPracticeExams
     */
    public static function getAllUserPracticeExamsByIdUser($idUser){

        $userPracticeExamService = new UserPracticeExamService;

        $userPracticeExams = $userPracticeExamService->getAllUserPracticeExamsByIdUser($idUser);

        if(!$userPracticeExams){
            return (new Response(404, 'application/json', ['message' => 'Não foi possível encontrar simulados do usuário', 'success' => false]))->sendResponse();
        }
        return $userPracticeExams;
    }

    /**
     * Finish user practice exam
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public static function finishUserPracticeExam($request){

        $jsonVars = $request->getJsonVars();

        $userPracticeExamService = new UserPracticeExamService;

        $insertUserPracticeExam = $userPracticeExamService->finishUserPracticeExam($jsonVars);

        if(!$insertUserPracticeExam){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível concluir a prova', 'success' => false]))->sendResponse();
        }
        return (new Response(201, 'application/json', ['message' => 'Prova concluida!', 'success' => true]))->sendResponse();
    }
}