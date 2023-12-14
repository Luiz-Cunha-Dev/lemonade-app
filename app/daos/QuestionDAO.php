<?php

namespace app\daos;

use app\models\QuestionModel;
use Exception;

/**
 * Question DAO
 * 
 * Responsible for reading and writing data of question entity
 * 
 * @package app\daos
 */ 
class QuestionDAO extends AbstractDAO {

    /**
     * Get question by id
     * 
     * @param integer id question
     * 
     * if its null, returns empty array
     * 
     * @return QuestionModel question
     */
    public function getQuestionById($idQuestion) {
    
        try {
    
            $question = parent::getElementByParameter('question', 'idQuestion', $idQuestion);
    
            if(empty($question)){
                return array();
            }
    
            $question = new QuestionModel($question['idQuestion'], $question['statement'], $question['idQuestionType']);
    
            return $question;
    
        } catch (Exception $e) {
            throw $e;
        }
        
    }

    /**
     * Get total of questions
     * 
     * if its null, returns empty array
     * 
     * @return integer totalQuestions
     */
    public function getTotalQuestios() {
    
        try {
    
            $totalQuestions = parent::countAllElements('question');
    
            if(empty($totalQuestions)){
                return array();
            }
    
            return $totalQuestions;
    
        } catch (Exception $e) {
            throw $e;
        }
        
    }

    /**
     * Insert question
     * 
     * @param $questionData
     * 
     * @return boolean
     */
    public function insertQuestion($questionData){

        try {
            return parent::insertElement('question', $questionData);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getMostRecentIdQuestion(){

        try {

            $sql = 'SELECT idQuestion FROM question ORDER BY idQuestion DESC LIMIT 1';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result) {
                $element = $result->fetch_assoc();
            } else {
                $element = array();
            }

            $result->free();

            return $element;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get all questions
     * 
     * if its null, returns empty array
     * 
     * @return array $questions
     */
    public function getAllQuestions() {
    
        try {
    
            $questions = parent::getAllElements('question');
    
            if(empty($questions)){
                return array();
            }
            
            $questions = array_map(function($q){

                return $q = new QuestionModel($q['idQuestion'], $q['statement'], $q['idQuestionType']);
                
            }, $questions);
            
    
            return $questions;
    
        } catch (Exception $e) {
            throw $e;
        }
        
    }
}
