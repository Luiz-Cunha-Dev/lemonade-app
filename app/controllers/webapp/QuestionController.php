<?php

namespace app\controllers\webapp;

use app\services\QuestionService;

class QuestionController{

    public static function getQuestionAlternativesByIdQuestion($idQuestion){

        $questionService = new QuestionService();

        $alternatives =   $questionService->getQuestionAlternativesByIdQuestion($idQuestion);

        return $alternatives;
    }

}