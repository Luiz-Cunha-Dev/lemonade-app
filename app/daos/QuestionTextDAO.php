<?php

namespace app\daos;

use app\models\QuestionTextModel;
use Exception;

/**
 * Question Text DAO
 * 
 * Responsible for reading and writing data of question text entity
 * 
 * @package app\daos
 */
class QuestionTextDAO extends AbstractDAO {

    /**
     * Get question texts by question id
     * 
     * @param integer id question
     * 
     * if its null, returns empty array
     * 
     * @return QuestionTextModel texts
     */
    public function getQuestionTextsByIdQuestion($idQuestion) {

        try {

            $texts = parent::getElementsByParameter('questionText', 'idQuestion', $idQuestion);

            if(empty($texts)){
                return array();
            }

            for($i = 0; $i < count($texts); $i++){
                $texts[$i] = new QuestionTextModel($texts[$i]['idQuestionText'], 
                $texts[$i]['text'], 
                $texts[$i]['idQuestion']);
            }
            
            return $texts;

        } catch (Exception $e) {
            throw $e;
        }
    }
    
}
