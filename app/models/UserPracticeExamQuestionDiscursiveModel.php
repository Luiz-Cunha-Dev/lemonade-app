<?php

namespace app\models;

/**
 * User practice exam question discursive model
 * 
 * Represents a user practiece exam discursive question in the application
 * 
 * @package app\models
 */
class UserPracticeExamQuestionAlternativeModel{

    /**
     * Id User Practice Exam id (fk)
     * 
     * @var integer $idUserPracticeExam
     */
    private $idUserPracticeExam;

    /**
     * Id  question  (fk)
     * 
     * @var integer $idQuestion
     */
    private $idQuestion;

    /**
     * Discursive question answer
     * 
     * @var string $answer
     */
    private $answer;

    /**
     * is correct  (fk)
     * 
     * @var boolean $isCorrect
     */
    private $isCorrect;

    /**
     * Class constructor
     * 
     * @param integer $idUserPracticeExam user practice exam id (fk)
     * @param integer $idQuestion question id (fk)
     * @param string $answer user answer
     * @param boolean $isCorrect is correct
     * @return UserPracticeExamQuestionDiscursiveModel
     */
    public function __construct($idUserPracticeExam, $idQuestion, $answer, $isCorrect ) {
        $this->idUserPracticeExam = $idUserPracticeExam;
        $this->idQuestion = $idQuestion;
        $this->answer = $answer;
        $this->isCorrect = $isCorrect;
    }

    /**
     * Get user practice exam id
     * 
     * @return integer Returns user practice exam id
     */
    public function getIdUserPracticeExam() {
        return $this->idUserPracticeExam;
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
     * Get answer
     * 
     * @return string Returns answer
     */
    public function getAnswer() {
        return $this->answer;
    }

    /**
     * Get isCorrect
     * 
     * @return integer Returns isCorrect
     */
    public function getIsCorrect() {
        return $this->isCorrect;
    }

    /**
     * Converts UserPracticeExamQuestionDiscursive to an array
     * 
     * @return array Returns UserPracticeExamQuestionDiscursive as an array
     */
    public function toArray() {
        return [
            'idUserPracticeExam' => $this->idUserPracticeExam,
            'idQuestion' => $this->idQuestion,
            'answer' => $this->answer,
            'isCorrect' => $this->isCorrect
        ];
    }
}

