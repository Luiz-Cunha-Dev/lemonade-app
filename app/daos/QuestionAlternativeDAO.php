<?php

namespace app\daos;

use app\models\QuestionAlternativeModel;
use Exception;

/**
 * Question alternative DAO
 * 
 * Responsible for reading and writing data of questionAlternative entity
 * 
 * @package app\daos
 */ 

 class QuestionAlternativeDAO extends AbstractDAO{

    /**
     * Get all question alternatives
     * 
     * If it is null, returns an empty array
     * 
     * @return array questionAlternatives
     */
    

    /**
     * Get question alternative by id
     * 
     * If it is null, returns an empty array
     * 
     * @return array $questionAlternative
     */
    public function getQuestionAlternativesByIdQuestion($idQuestion){

        try {

            $questionAlternatives = parent::getElementsByParameter('questionAlternative', 'idQuestion', $idQuestion);

            if(empty($questionAlternatives)){
                
                return array();
            }
            for($i = 0; $i < count($questionAlternatives); $i++){
                $questionAlternatives[$i] = new QuestionAlternativeModel(
                $questionAlternatives[$i]['idQuestionAlternative'], 
                $questionAlternatives[$i]['letter'], 
                $questionAlternatives[$i]['text'], 
                $questionAlternatives[$i]['isCorrect'], 
                $questionAlternatives[$i]['idQuestion']);
            }
            return $questionAlternatives;
            
        } catch (\Exception $e) {
            throw new $e();
        }
    }

    
 }
