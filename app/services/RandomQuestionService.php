<?php

namespace app\services;

use app\daos\QuestionDAO;
use app\daos\QuestionAlternativeDAO;
use app\daos\QuestionTextDAO;

use app\models\QuestionModel;

/**
 * Random question service
 * 
 * Responsible for return a random question for client side
 * 
 * @package app\services
 */
class RandomQuestionService extends AbstractService{

    /**
     * Question DAO
     * @var questionDAO $questionDAO
     */
    private $questionDAO;

     /**
     * Question alternative DAO
     * @var questionAlternativeDAO $questionAlternativeDAO
     */
    private $questionAlternativeDAO;

    /**
     * Question text DAO
     * @var questionTextDAO $questionTextDAO
     */
    private $questionTextDAO;

    /**
     * Class constructor
     * 
     * Return a new RandomQuestionService instance
     */
    public function __construct()
    {
        parent::__construct();
        $this->questionDAO = new QuestionDAO($this->conn->getConnection());
        $this->questionAlternativeDAO = new QuestionAlternativeDAO($this->conn->getConnection());
        $this->questionTextDAO = new QuestionTextDAO($this->conn->getConnection());
    }


    public function getRandomQuestion(){

        $totalQuestions = $this->questionDAO->getTotalQuestios();

        $randomQuestion = $this->questionDAO->getQuestionById(random_int(1,$totalQuestions['questionCount']));

        $randomQuestionId = $randomQuestion->getIdQuestion();

        $randomQuestionText = $this->questionTextDAO->getQuestionTextsByIdQuestion($randomQuestionId);

        $randomQuestionAlternatives = $this->questionAlternativeDAO->getQuestionAlternativesByIdQuestion($randomQuestionId);

        $randomQuestionAlternativesArray = array_map(function ($qa){
            return [
                'text' => $qa->getText(),
                'isCorrect' => $qa->getIsCorrect()
            ];
        }, $randomQuestionAlternatives);

        $i=0;

        foreach($randomQuestionAlternatives as $qa){

            $randomQuestionAlternativesArray[$i] = [
                'text' => $qa->getText(),
                'isCorrect' => $qa->getIsCorrect()
            ];
            $i++;
        }
        
        $jsonQuestion = [
            'idQuestion' => $randomQuestionId,
            'text' => $randomQuestionText[0]->getText(),
            'statement' => $randomQuestion->getStatement(),
            'alternatives' => $randomQuestionAlternativesArray
        ];

        return $jsonQuestion;

    }
    
}