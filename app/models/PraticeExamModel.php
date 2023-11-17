<?php

namespace app\models;

/**
 * Pratice exam model
 * 
 * Represents a pratice exam in the application
 * 
 * @package app\models
 */
class PraticeExamModel {

    /**
     * Pratice exam id
     * 
     * @var integer $idPraticeExam
     */
    private $idPraticeExam;

     /**
     * Pratice exam name
     * 
     * @var string $name
     */
    private $name;

     /**
     * Pratice exam description
     * 
     * @var string $description
     */
    private $description;

    /**
     * Class constructor
     * 
     * @param integer $idPraticeExam pratice exam id
     * @param string $name pratice exam name
     * @param string $description patice exam description
     * @return PraticeExamModel
     */
    public function __construct($idPraticeExam, $name, $description)
    {
        $this->idPraticeExam = $idPraticeExam;
        $this->name = $name;
        $this->description = $description;
    }

     /**
     * Get pratice exam id
     * 
     * @return integer Returns pratice exam id
     */
    public function getIdPraticeExam() {
        return $this->idPraticeExam;
    }

    /**
     * Get pratice exam name
     * 
     * @return integer Returns pratice name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Get pratice exam description
     * 
     * @return integer Returns pratice exam description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set pratice exam id
     * 
     * @param integer $idPraticeExam pratice exam id
     */
    public function setPraticeExamId($idPraticeExam) {
        $this->idPraticeExam = $idPraticeExam;
    }

    /**
     * Set pratice exam name
     * 
     * @param string $name pratice exam name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set pratice exam description
     * 
     * @param string $description pratice exam description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Converts the pratice exam to an array
     * 
     * @return array Returns the pratice exam as an array
     */
    public function toArray() {
        return [
            'idPraticeExam' => $this->idPraticeExam,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }

}