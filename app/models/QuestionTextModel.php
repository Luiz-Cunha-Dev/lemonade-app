<?php 

namespace app\models;

/**
 * Question text model
 * 
 * Represents a questions text in the application
 * 
 * @package app\models
 */ 
class QuestionTextModel {

    /**
     * Question text id
     * 
     * @var integer $idQuestionText
     */
    private $idQuestionText;

    /**
     * Question text
     * 
     * @var string $test
     */
    private $text;

    /**
     * Question id
     * 
     * @var integer $idQuestion
     */
    private $idQuestion;


    /**
     * Class constructor
     * 
     * @param integer $idQuestionText question text id
     * @param string $text text in the question
     * @param integer $idQuestion question id
     * 
     * 
     * @return QuestionTextModel question text
     */
    public function __construct($idQuestionText, $text, $idQuestion) {
        $this->idQuestionText = $idQuestionText;
        $this->text = $text;
        $this->idQuestion = $idQuestion;
        
    }

    /**
     * Get question text id
     * 
     * @return integer Returns the text question id
     */
    public function getIdQuestionText() {
        return $this->idQuestionText;
    }

    /**
     * Get the question text
     * 
     * @return string Returns question text
     */
    public function getText() {
        return $this->text;
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
     * Set question text id
     * 
     * @param integer $idQuestionText question text id
     */
    public function setIdQuestionText($idQuestionText) {
        $this->idQuestionText = $idQuestionText;
    }

    /**
     * Set text question
     * 
     * @param string $text text question
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * Set id question
     * 
     * @param integer $idQuestion the id question
     */
    public function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
    }


    /**
     * Converts the question text to an array.
     * 
     * @return array Returns the question text as an array
     */
    public function toArray() {
        return [
            'idQuestionText' => $this->idQuestionText,
            'text' => $this->text,
            'idQuestion' => $this->idQuestion,
        ];
    }

}
