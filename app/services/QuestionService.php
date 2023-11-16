<?php

namespace app\services;

use app\daos\QuestionAlternativeDAO;
use app\daos\QuestionDAO;
use app\daos\QuestionTextDAO;

class QuestionService extends AbstractService{

    private $questionAlternativeDAO;
    private $questionDAO; 
    private $questionTextDAO;

    public function __construct()
    {
        parent::__construct();
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
        $this->questionDAO = new QuestionDAO($this->conn->getConnection());
        $this->questionTextDAO = new QuestionTextDAO($this->conn->getConnection());
    }

    public function getQuestionAlternativesByIdQuestion($idQuestion){

        $alternatives = $this->questionAlternativeDAO->getQuestionAlternativesByIdQuestion($idQuestion);   
        
        $alternatives = array_map(function($a){
            return $a->toArray();
        }, $alternatives);

        $this->questionAlternativeDAO->closeConnection();

        return $alternatives;

    }

    public function getQuestionById($idQuestion){

        $question = $this->questionDAO->getQuestionById($idQuestion);

        $question = $question->toArray();

        $this->questionDAO->closeConnection();

        return $question;
    }

    public function getQuestionTextsByIdQuestion($idQuestion){

        $texts = $this->questionTextDAO->getTextByIdQuestion($idQuestion);

        $texts = array_map(function($t){
            return $t->toArray();
        }, $texts);

        $this->questionTextDAO->closeConnection();

        return $texts;
    }
}