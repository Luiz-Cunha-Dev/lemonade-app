<?php 

namespace app\models;

/**
 * Question type model
 * 
 * Represents a type questions in the application
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
     * 
     * 
     * 
     * @return QuestionTypeModel question type
     */

    public function __construct($idQuestionType, $name, $idQuestionType) {
        $this->idQuestionType = $idQuestionType;
        $this->name = $name;
        
        
    }

    /**
     * Get question type id
     * 
     * @return integer Returns the question type id
     */
    public function getIdQuestionType() {
        return $this->idQuestionType;
    }

    /**
     * Get the question type name
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
     * Set name question type
     * 
     * @param string $name name question type
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
