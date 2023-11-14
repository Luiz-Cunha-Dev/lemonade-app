<?php 

namespace app\models;

/**
 * Question model
 * 
 * Represents a questions in the application
 * 
 * @package app\models
 */ 
class QuestionModel {

    /**
     * Question id
     * 
     * @var integer $idQuestion
     */
    private $idQuestion;

    /**
     * Question statement
     * 
     * @var string $statement
     */
    private $statement;

    /**
     * Question id type
     * 
     * @var integer $idQuestionType
     */
    private $idQuestionType;


    /**
     * Class constructor
     * 
     * @param integer $idQuestion question id
     * @param string $statement stantement
     * @param integer $idQuestionType type question id
     * 
     * 
     * @return QuestionModel question
     */
    public function __construct($idQuestion, $statement, $idQuestionType) {
        $this->idQuestion = $idQuestion;
        $this->statement = $statement;
        $this->idQuestionType = $idQuestionType;
        
    }

    /**
     * Get question id
     * 
     * @return integer Returns the question id
     */
    public function getIdQuestion() {
        return $this->idQuestion;
    }

    /**
     * Get the question statement
     * 
     * @return string Returns question statement
     */
    public function getStatement() {
        return $this->statement;
    }

    /**
     * Get id question type
     * 
     * @return integer Returns id question type
     */
    public function getIdQuestionType() {
        return $this->idQuestionType;
    }


    /**
     * Set question id
     * 
     * @param integer $idQuestion question id
     */
    public function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
    }

    /**
     * Set statement question
     * 
     * @param string $statement statement question
     */
    public function setStatement($statement) {
        $this->statement = $statement;
    }

    /**
     * Set id question type
     * 
     * @param integer $idQuestionType the id question type
     */
    public function setIdQuestionType($idQuestionType) {
        $this->idQuestionType = $idQuestionType;
    }


    /**
     * Converts the question to an array.
     * 
     * @return array Returns the question as an array
     */
    public function toArray() {
        return [
            'idQuestion' => $this->idQuestion,
            'statement' => $this->statement,
            'idQuestionType' => $this->idQuestionType,
        ];
    }

}
