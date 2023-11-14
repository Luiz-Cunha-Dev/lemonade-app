<?php 

namespace app\models;

/**
 * Question Type model
 * 
 * Represents a question type in the application
 * 
 * @package app\models
 */ 
class QuestionTypeModel {

    /**
     * Question type id
     * 
     * @var integer $idQuestionType
     */
    private $idQuestionType;

    /**
     * Question type name
     * 
     * @var string $name
     */
    private $name;

    /**
     * Class constructor
     * 
     * @param integer $idQuestionType question type id
     * @param string $name question type name
     * @return QuestionTypeModel
     */

    public function __construct($idQuestionType, $name) {
        $this->idQuestionType = $idQuestionType;
        $this->name = $name;
    }

    /**
     * Get question type id
     * 
     * @return integer Returns question type id
     */
    public function getIdQuestionType() {
        return $this->idQuestionType;
    }

    /**
     * Get question type name
     * 
     * @return string Returns question type name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set question type id
     * 
     * @param integer $idQuestionType question type id
     */
    public function setIdQuestionType($idQuestionType) {
        $this->idQuestionType = $idQuestionType;
    }

    /**
     * Set question type name
     * 
     * @param string $name question type name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Converts the question type to an array.
     * 
     * @return array Returns the question type as an array
     */
    public function toArray() {
        return [
            'idQuestionType' => $this->idQuestionType,
            'name' => $this->name,
        ];
    }

}
