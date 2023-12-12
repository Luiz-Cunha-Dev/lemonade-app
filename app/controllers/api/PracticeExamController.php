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

        
        $PracticeExamService = new PracticeExamService;

        $PracticeExamQuestions = $PracticeExamService->getPracticeExamQuestions($idPracticeExam);

        if(!$PracticeExamQuestions){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $PracticeExamQuestions;
    }

    /**
     * Get all practice exams
     * 
     * @return array $PracticeExams
     */
    public static function getAllPracticeExams(){

        
        $PracticeExamService = new PracticeExamService;

        $PracticeExams = $PracticeExamService->getAllPracticeExams();

        if(!$PracticeExams){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $PracticeExams;
    }
}