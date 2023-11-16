<?php

namespace app\daos;

use app\models\QuestionTextModel;
use Exception;

/**
 * Question text DAO
 * 
 * Responsible for reading and writing data of questionText entity
 * 
 * @package app\daos
 */
class QuestionTextDAO extends AbstractDAO
{

    /**
     * Get question text by question id
     * 
     * @param integer id question
     * 
     * if its null, returns empty array
     * 
     * @return array texts
     */

    public function getTextByIdQuestion($idQuestion) {

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

        } catch (\Exception $e) {
            throw new Exception();
        }
    }
}
