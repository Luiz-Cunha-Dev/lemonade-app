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

        if(empty($practiceExams)){
            return (new Response(400, 'application/json', ['message' => 'Não foi possível recuperar as questões', 'success' => false]))->sendResponse();
        }
        
        return $practiceExams;
    }

    /**
     * Get all practice exams
     * 
     * @return array $PracticeExams
     */
    public static function insertUserCreatedPracticeExam($request){

        $practiceExamService = new PracticeExamService;

        $jsonVars = $request->getJsonVars();

        $insertUserCreatedPracticeExam = $practiceExamService->insertUserCreatedPracticeExam($jsonVars);
        //print_r()
        if(!$insertUserCreatedPracticeExam){

            return (new Response(400, 'application/json', ['message' => 'Não foi possível criar a prova', 'success' => false]))->sendResponse();
        }

        return (new Response(201, 'application/json', ['message' => 'Prova criada com sucesso!', 'success' => true]))->sendResponse();
    }
}
