<?php

namespace app\controllers\api;

use app\services\PracticeExamService;
use app\routes\http\Response;

/**
 * Practice exam controller
 * 
 * @package app\controllers\api
 */
class PracticeExamController{

    /**
     * Get user practice exam questions
     * 
     * @param Request $request
     * 
     * @return array $PracticeExamQuestions
     */
    public static function getPracticeExamQuestions($idPracticeExam){

        
        $PracticeExamService = new PracticeExamService;

        $PracticeExamQuestions = $PracticeExamService->getPracticeExamQuestions($idPracticeExam);

        if(!$PracticeExamQuestions){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $PracticeExamQuestions;
    }
}