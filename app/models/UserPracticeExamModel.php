<?php

namespace app\models;

/**
 * User practice exam model
 * 
 * Represents a user practice exam in the application
 * 
 * @package app\models
 */
class UserPracticeExamModel{

    /**
     * User practice exam id
     * 
     * @var integer $idUserPracticeExam
     */
    private $idUserPracticeExam;

    /**
     * User practice exam start date
     * 
     * @var Date $startDate
     */
    private $startDate;

    /**
     * User practice exam end date
     * 
     * @var Date $endDate
     */
    private $endDate;

    /**
     * User practice exam grade
     * 
     * @var integer $grade
     */
    private $grade;

    /**
     * User practice exam id user
     * 
     * @var integer $idUser(fk)
     */
    private $idUser;

    /**
     * User practice exam id exam
     * 
     * @var integer $idPracticeExam(fk)
     */
    private $idPracticeExam;

    /**
     * Class constructor
     * 
     * @param integer $idpracticeExam practice exam id
     * @param string $name practice exam name
     * @param string $description patice exam description
     * @return practiceExamModel
     */
    public function __construct($idUserPracticeExam, $startDate, $endDate, $idUser, $idPracticeExam)
    {
        $this->idUserPracticeExam = $idUserPracticeExam;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->idUser = $idUser;
        $this->idPracticeExam = $idPracticeExam;
    }

    /**
     * Get user practice exam id
     * 
     * @return integer Returns user practice exam id
     */
    public function getIdUserpracticeExam() {
        return $this->idUserPracticeExam;
    }

    /**
     * Get user practice exam start date
     * 
     * @return Date Returns user practice exam start date
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * Get user practice exam endDate
     * 
     * @return Date Returns user practice exam endDate
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * Get user practice exam id User
     * 
     * @return integer Returns user practice exam id User
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * Get user practice exam id practice exam
     * 
     * @return integer Returns user practice exam id practice exam
     */
    public function getIdPracticeExam() {
        return $this->idPracticeExam;
    }

    /**
     * Set user practice exam id
     * 
     * @param integer $idUserpracticeExam user practice exam id
     */
    public function setIdUserPracticeExamId($idUserPracticeExam) {
        $this->idUserPracticeExam = $idUserPracticeExam;
    }

    /**
     * Set user practice exam start date
     * 
     * @param Date $startDate user practice exam start date
     */
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    /**
     * Set user practice exam end date
     * 
     * @param Date $startDate user practice exam end date
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

    /**
     * Set user practice exam id user
     * 
     * @param integer $idUserpracticeExam user practice exam id user
     */
    public function setidUser($idUser) {
        $this->idUser = $idUser;
    }

    /**
     * Set user practice exam id practice exam
     * 
     * @param integer $idUserpracticeExam user practice exam id practice exam
     */
    public function setIdPracticeExam($idPracticeExam) {
        $this->idPracticeExam = $idPracticeExam;
    }

    /**
     * Converts the user practice exam to an array
     * 
     * @return array Returns the user practice exam as an array
     */
    public function toArray() {
        return [
            'idUserPracticeExam' => $this->idUserPracticeExam,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'idUser' => $this->idUser,
            'idPracticeExam' => $this->idPracticeExam
        ];
    }
}