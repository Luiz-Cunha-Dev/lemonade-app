<?php 

namespace app\models;

/**
 * Question Text model
 * 
 * Represents a question text in the application
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
     * @var string $text
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
     * @param string $text question text
     * @param integer $idQuestion question id (fk)
     * @return QuestionTextModel
     */
    public function __construct($idQuestionText, $text, $idQuestion) {
        $this->idQuestionText = $idQuestionText;
        $this->text = $text;
        $this->idQuestion = $idQuestion;
        
    }

    /**
     * Get question text id
     * 
     * @return integer Returns question text id
     */
    public function getIdQuestionText() {
        return $this->idQuestionText;
    }

    /**
     * Get question text
     * 
     * @return string Returns question text
     */
    public function getText() {
        return $this->text;
    }

    /**
     * Get id question 
     * 
     * @return integer Returns question id (fk)
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
     * Set question text
     * 
     * @param string $text question text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * Set id question
     * 
     * @param integer $idQuestion question id (fk)
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
