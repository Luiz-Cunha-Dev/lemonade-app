<?php

namespace app\services;

use app\daos\QuestionAlternativeDAO;

class QuestionService extends AbstractService{

    private $questionAlternativeDAO; 

    public function __construct()
    {
        parent::__construct();
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
    }

    public function getQuestionAlternativesByIdQuestion($idQuestion){

        $alternatives = $this->questionAlternativeDAO->getQuestionAlternativesByIdQuestion($idQuestion);   
        
        $alternatives = array_map(function($a){
            return $a->toArray();
        }, $alternatives);

        $this->questionAlternativeDAO->closeConnection();

        return $alternatives;

    }
}