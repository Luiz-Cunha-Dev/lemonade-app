<?php

namespace app\controllers\api;

use app\services\QuestionService;
use app\routes\http\Response;

/**
 * Question controller
 * 
 * @package app\controllers\api
 */
class QuestionController {

    /**
     * Insert user created question
     * 
     * @return boolean
     */
    public static function insertUserCreatedQuestion($request){

        $questionService = new QuestionService;

        $jsonVars = $request->getJsonVars();

        $insertUserCreatedQuestion = $questionService->insertUserCreatedQuestion($jsonVars);
        
        if(!$insertUserCreatedQuestion){

            return (new Response(400, 'application/json', ['message' => 'Não foi possível criar a questao', 'success' => false]))->sendResponse();
        }

        return (new Response(201, 'application/json', ['message' => 'Questão criada com sucesso!', 'success' => true]))->sendResponse();
    }

    /**
     * Get all questions
     * 
     */
    public static function getAllQuestions(){

        $questionService = new QuestionService;

        $questions = $questionService->getAllQuestions();
        
        if(empty($questions)){

            return (new Response(404, 'application/json', ['message' => 'Não foi possível localizar as questões', 'success' => false]))->sendResponse();
        }

        return $questions;
    }

}