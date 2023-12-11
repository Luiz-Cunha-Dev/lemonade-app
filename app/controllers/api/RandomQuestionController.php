<?php

namespace app\controllers\api;

use app\services\RandomQuestionService;
use app\routes\http\Response;

/**
 * User random question controller
 * 
 * @package app\controllers\api
 */
class RandomQuestionController{


    /**
     * Get random question
     * @return 
     */
    public static function getRandomQuestion(){

        $randomQuestionService = new RandomQuestionService;

        $randomQuestion = $randomQuestionService->getRandomQuestion();

        return $randomQuestion; 
    }
}