<?php

namespace app\daos;

use app\models\QuestionDiscursiveModel;
use Exception;

/**
 * Question discursive DAO
 * 
 * Responsible for reading and writing data of discursive question entity
 * 
 * @package app\daos
 */
class QuestionDiscursiveDAO extends AbstractDAO{

    /**
     * Get discursive question by idQuestion
     * 
     * @param integer id question
     * 
     * if its null, returns empty array
     * 
     * @return QuestionDiscursiveModel questionDiscursive
     */
    public function getQuestionDiscursiveByIdQuestion($idQuestion) {
    
        try {
    
            $questionDiscursive = parent::getElementByParameter('questionDiscursive', 'idQuestion', $idQuestion);
    
            if(empty($questionDiscursive)){
                return array();
            }
    
            $questionDiscursive = new QuestionDiscursiveModel($questionDiscursive['idQuestionDiscursive'],
            $questionDiscursive['baseResponse'], 
            $questionDiscursive['idQuestion']);
    
            return $questionDiscursive;
    
        } catch (Exception $e) {
            throw $e;
        }
        
    }

} 