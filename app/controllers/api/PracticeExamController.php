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
     * Get practice exam questions
     * 
     * @param $idPracticeExam
     * 
     * @return array $PracticeExamQuestions
     */
    public static function getPracticeExamQuestions($idPracticeExam){

        
        $practiceExamService = new PracticeExamService;

        $practiceExamQuestions = $practiceExamService->getPracticeExamQuestions($idPracticeExam);

        if(!$practiceExamQuestions){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $practiceExamQuestions;
    }

    /**
     * Get all practice exams
     * 
     * @return array $PracticeExams
     */
    public static function getAllPracticeExams(){

        
        $practiceExamService = new PracticeExamService;

        $practiceExams = $practiceExamService->getAllPracticeExams();

        if(!$practiceExams){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $practiceExams;
    }
}
