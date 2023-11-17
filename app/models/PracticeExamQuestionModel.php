<?php

namespace app\models;

/**
 * Practice exam question model
 * 
 * Represents a practice exam question in the application
 * 
 * @package app\models
 */
class PracticeExamQuestionModel{

    /**
     * practice exam id
     * 
     * @var integer $idPracticeExam
     */
    private $idPracticeExam;

     /**
     * Question id
     * 
     * @var integer $idQuestion
     */
    private $idQuestion;

    /**
     * Class constructor
     * 
     * @param integer $idPracticeExam  practice exam id(fk)
     * @param integer $idQuestion question id(fk)
     * @return PraticeExamQuestionModel practice exam Question
     */
    public function __construct($idPracticeExam, $idQuestion)
    {
        $this->idPracticeExam = $idPracticeExam;
        $this->idQuestion = $idQuestion;
    }

     /**
     * Get practice exam id
     * 
     * @return integer Returns practice exam id
     */
    public function getPracticeExamId() {
        return $this->idPracticeExam;
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
     * Set practice id
     * 
     * @param integer $idPractice exam id
     */
    public function setIdPracticeExam($idPracticeExam) {
        $this->idPracticeExam = $idPracticeExam;
    }

    /**
     * Set question id
     * 
     * @param integer $idQuestion question  id
     */
    public function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
    }

      /**
     * Converts the practice exam question to an array
     * 
     * @return array Returns the practice question exam as an array
     */
    public function toArray() {
        return [
            'idPracticeExam' => $this->idPracticeExam,
            'idQuestion' => $this->idQuestion,
        ];
    }


}