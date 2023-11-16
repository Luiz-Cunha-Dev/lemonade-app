<?php

namespace app\daos;

use app\models\QuestionModel;
use Exception;

/**
 * Question alternative DAO
 * 
 * Responsible for reading and writing data of question entity
 * 
 * @package app\daos
 */ 
class QuestionDAO extends AbstractDAO{

/**
 * Get question by id
 * 
 * @param integer id question
 * 
 * if its null, returns empty array
 * 
 * @return QuestionModel question
 */
public function getQuestionById($idQuestion){

    try {

        $question = parent::getElementByParameter('question', 'idQuestion', $idQuestion);

        if(empty($question)){
            return array();
        }

        $question = new QuestionModel($question['idQuestion'], $question['statement'], $question['idQuestionType']);

        return $question;

    } catch (\Exception $e) {
        throw new Exception();
    }
}



}