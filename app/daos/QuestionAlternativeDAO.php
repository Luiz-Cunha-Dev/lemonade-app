<?php

namespace app\daos;

use app\models\QuestionAlternativeModel;
use Exception;

/**
 * Question Alternative DAO
 * 
 * Responsible for reading and writing data of question alternatives entity
 * 
 * @package app\daos
 */ 
 class QuestionAlternativeDAO extends AbstractDAO{

    /**
     * Get question alternatives by id
     * 
     * @param integer id question
     * 
     * If it is null, returns an empty array
     * 
     * @return array QuestionAlternative alternatives
     */
    public function getQuestionAlternativesByIdQuestion($idQuestion) {

        try {

            $questionAlternatives = parent::getElementsByParameter('questionAlternative', 'idQuestion', $idQuestion);

            if(empty($questionAlternatives)){
                return array();
            }
         
            for($i = 0; $i < count($questionAlternatives); $i++) {
                $questionAlternatives[$i] = new QuestionAlternativeModel(
                $questionAlternatives[$i]['idQuestionAlternative'], 
                $questionAlternatives[$i]['text'], 
                $questionAlternatives[$i]['isCorrect'], 
                $questionAlternatives[$i]['idQuestion']);
            }
         
            return $questionAlternatives;
            
        } catch (Exception $e) {
            throw $e;
        }
     
    }

    /**
     * Get question alternative by id question alternative
     * 
     * @param integer id question alternative
     * 
     * If it is null, returns an empty array
     * 
     * @return QuestionAlternative alternatives
     */
    public function getQuestionAlternativeByIdQuestionAlternative($idQuestionAlternative){

        try {

            $questionAlternatives = parent::getElementByParameter('questionAlternative', 'idQuestionAlternative', $idQuestionAlternative);

            if(empty($questionAlternatives)){
                return array();
            }
            
            $questionAlternatives = new QuestionAlternativeModel(
                $questionAlternatives['idQuestionAlternative'], 
                $questionAlternatives['letter'], 
                $questionAlternatives['text'], 
                $questionAlternatives['isCorrect'], 
                $questionAlternatives['idQuestion']
            );
        
            return $questionAlternatives;
            
        } catch (Exception $e) {
            throw $e;
        }

    }
    
 }
