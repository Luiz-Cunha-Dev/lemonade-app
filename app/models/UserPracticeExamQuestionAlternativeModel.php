<?php

namespace app\models;

/**
 * User practice exam Question Alternative model
 * 
 * Represents a user practiece exam question alternative in the application
 * 
 * @package app\models
 */ 
class UserPracticeExamQuestionAlternativeModel {

    /**
     * Id User Practice Exam id (fk)
     * 
     * @var integer $idUserPracticeExam
     */
    private $idUserPracticeExam;

    /**
     * Id  question alternative (fk)
     * 
     * @var integer $idQuestionAlternative
     */
    private $idQuestionAlternative;

    /**
     * Class constructor
     * 
     * @param integer $idUserPractice exam 
     * @param boolean $idQuestionAlternative
     * @return UserPracticeExamQuestionAlternativeModel
     */
    public function __construct($idUserPracticeExam, $idQuestionAlternative) {
        $this->idUserPracticeExam = $idUserPracticeExam;
        $this->idQuestionAlternative = $idQuestionAlternative; 
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
     * Get user question alternative id
     * 
     * @return integer Returns question alternative id
     */
    public function getIdQuestionAlternative() {
        return $this->idQuestionAlternative;
    }

    /**
     * Converts UserPracticeExamQuestionAlternative to an array
     * 
     * @return array Returns UserPracticeExamQuestionAlternative as an array
     */
    public function toArray() {
        return [
            'idUserPracticeExam' => $this->idUserPracticeExam,
            'idQuestionAlternative' => $this->idQuestionAlternative,
        ];
    }

}