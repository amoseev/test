<?php

class ValidatorQuestionsAndAnswers extends CValidator {
//при сохранении теста проверяет всё ли заполнено у вопросов и ответов к ним

    protected function ReadMapQuestionsAnswersErr($MapQuestionsAnswersErr){
        $questionsErr=array_keys($MapQuestionsAnswersErr);
        $errMessage=array();
        foreach($questionsErr as $questionErr){
            $errMessage[]= "Вопрос: ".($questionErr).", Ответы: ".implode(", ", array_values($MapQuestionsAnswersErr[$questionErr]));
        }
        return $errMessage;
    }

    protected function validateAttribute($object,$attribute)
    {

        $listQuestions = $object[$attribute];

        if($this->isEmpty($listQuestions) || count($listQuestions)<1){
            $this->addError($object,$attribute,'Необходимо добавить Вопросы к тесту');
            return;
        }

        $result = $resultAnswer = array();

        foreach($listQuestions as $qn=>$question){
            $question->validate();//после валидации вопроса можно валидацию ответов проводить)
            foreach($question->getErrors() as $attribute=>$errors){
                forEach($errors as $err){
                    $result[$attribute][$err][]=$qn+1;
                }
            }
            if(isset($question->answers)){
                foreach($question->answers as $an=>$answer){
                    $answer->validate();
                    foreach($answer->getErrors() as $attribute=>$errors){
                        forEach($errors as $err){
                            $resultAnswer[$attribute][$err][$qn+1][]=$an+1;
                            echo $attribute.$err.($qn+1).($an+1);
                        }
                    }
                }
            }
        }

        foreach($result as $mapErrKey){
            $arrErrors = array_keys($mapErrKey);
            foreach($arrErrors as $errorDesc){
                $arrQuestionsErr = array_values($mapErrKey[$errorDesc]);
                $this->addError($object,$attribute,$errorDesc." Вопросы: ".implode(", ", $arrQuestionsErr));
            }
        }

        foreach($resultAnswer as $mapErrKey){
            $arrErrors = array_keys($mapErrKey);
            foreach($arrErrors as $errorDesc){
                $mapQuestionsAnswersErr = $mapErrKey[$errorDesc];
                $this->addError($object,$attribute,$errorDesc."<br>".implode("<br>",$this->ReadMapQuestionsAnswersErr($mapQuestionsAnswersErr)));
            }
        }

    }

}