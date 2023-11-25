<?php

namespace app\models;

/**
 * Practice exam model
 * 
 * Represents a practice exam in the application
 * 
 * @package app\models
 */
class PracticeExamModel {

    /**
     * practice exam id
     * 
     * @var integer $idPracticeExam
     */
    private $idPracticeExam;

     /**
     * Practice exam name
     * 
     * @var string $name
     */
    private $name;

     /**
     * Practice exam description
     * 
     * @var string $description
     */
    private $description;

    /**
     * Class constructor
     * 
     * @param integer $idpracticeExam practice exam id
     * @param string $name practice exam name
     * @param string $description patice exam description
     * @return practiceExamModel
     */
    public function __construct($idpracticeExam, $name, $description)
    {
        $this->idPracticeExam = $idpracticeExam;
        $this->name = $name;
        $this->description = $description;
    }

     /**
     * Get practice exam id
     * 
     * @return integer Returns practice exam id
     */
    public function getIdpracticeExam() {
        return $this->idPracticeExam;
    }

    /**
     * Get practice exam name
     * 
     * @return integer Returns practice name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get practice exam description
     * 
     * @return integer Returns practice exam description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set practice exam id
     * 
     * @param integer $idPracticeExam practice exam id
     */
    public function setPracticeExamId($idPracticeExam) {
        $this->idPracticeExam = $idPracticeExam;
    }

    /**
     * Set practice exam name
     * 
     * @param string $name practice exam name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set practice exam description
     * 
     * @param string $description practice exam description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Converts the practice exam to an array
     * 
     * @return array Returns the practice exam as an array
     */
    public function toArray() {
        return [
            'idPracticeExam' => $this->idPracticeExam,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

}