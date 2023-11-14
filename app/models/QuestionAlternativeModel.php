<?php 

namespace app\models;

/**
 * Question alternative model
 * 
 * Represents a questions alternative in the application
 * 
 * @package app\models
 */ 
class QuestionAlternativeModel {

    /**
     * Question alternative id
     * 
     * @var integer $idQuestionAlternative
     */
    private $idQuestionAlternative;

    /**
     * Do the question is correct?
     * 
     * @var string $isCorrect
     */
    private $isCorrect;

    /**
     * Question id 
     * 
     * @var string $idQuestion
     */
    private $idQuestion;


    /**
     * Class constructor
     * 
     * @param integer $idQuestionAlternative the alternative question id
     * @param boolean $isCorrect do the question is correct?
     * @param integer $idQuestion question id
     * 
     * 
     * @return QuestionAlternativeModel question
     */
    public function __construct($idQuestionAlternative, $isCorrect, $idQuestion) {
        $this->idQuestionAlternative = $idQuestionAlternative;
        $this->isCorrect = $isCorrect;
        $this->idQuestion = $idQuestion;
        
    }

    /**
     * Get question alternative id
     * 
     * @return integer Returns the question alternative id
     */
    public function getIdQuestionAlternative() {
        return $this->idQuestionAlternative;
    }

    /**
     * Get the question correct or not
     * 
     * @return boolean Returns question is correct? statement
     */
    public function getIsCorrect() {
        return $this->isCorrect;
    }

    /**
     * Get id question
     * 
     * @return integer Returns id question
     */
    public function getIdQuestion() {
        return $this->idQuestion;
    }


    /**
     * Set question alternative id
     * 
     * @param integer $idQuestionAlternative question id
     */
    public function setIdQuestionAlternative($idQuestionAlternative) {
        $this->idQuestionAlternative = $idQuestionAlternative;
    }

    /**
     * Set is correct question?
     * 
     * @param boolean $isCorrect is correct question?
     */
    public function setIsCorrect($isCorrect) {
        $this->isCorrect = $isCorrect;
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
     * Converts the question alternative to an array.
     * 
     * @return array Returns the question alternative as an array
     */
    public function toArray() {
        return [
            'idQuestionAlternative' => $this->idQuestionAlternative,
            'isCorrect' => $this->isCorrect,
            'idQuestion' => $this->idQuestion,
        ];
    }

}
