<?php

/**
 * Question discursive model
 * 
 * Represents a discursive in the application
 * 
 * @package app\models
 */
class QuesitonDiscursiveModel{

    /**
     * Question discursive id
     * 
     * @var integer $idQuestionDiscursive
     */
    private $idQuestionDiscursive;

    /**
     * Question base response
     * 
     * @var string $baseResponse
     */
    private $baseResponse;

    /**
     * Question id
     * 
     * @var integer $idQuestion
     */
    private $idQuestion;

    /**
     * Class constructor
     * 
     * @param integer $idQuestionDiscursive discursive question id
     * @param string $baseResponse base response
     * @param integer $idQuestion question id (fk)
     * @return QuestionDiscursiveModel
     */
    public function __construct($idQuestionDiscursive, $baseResponse, $idQuestion) {
        $this->idQuestionDiscursive = $idQuestionDiscursive;
        $this->baseResponse = $baseResponse;
        $this->idQuestion = $idQuestion;
    }

    /**
     * Get question discursive id
     * 
     * @return integer Returns question discursive id
     */
    public function getIdQuestionDiscursive() {
        return $this->idQuestionDiscursive;
    }

    /**
     * Get the question base response
     * 
     * @return string Returns question base response
     */
    public function getbaseResponse() {
        return $this->baseResponse;
    }

    /**
     * Get question id
     * 
     * @return integer Returns question id
     */
    public function getIdQuestion() {
        return $this->idQuestion;
    }

    /**
     * Set discursive question id
     * 
     * @param integer $idQuestionDiscursive discursive question id
     */
    public function setIdQuestionDiscursive($idQuestionDiscursive) {
        $this->idQuestionDiscursive = $idQuestionDiscursive;
    }

    /**
     * Set question base response
     * 
     * @param string $baseResponse question base response
     */
    public function setBaseResponse($baseResponse) {
        $this->baseResponse = $baseResponse;
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
     * Converts discursive question in to an array.
     * 
     * @return array Returns the discursive question as an array
     */
    public function toArray() {
        return [
            'idQuestionDiscursive' => $this->idQuestionDiscursive,
            'baseResponse' => $this->baseResponse,
            'idQuestion' => $this->idQuestion,
        ];
    }
}

