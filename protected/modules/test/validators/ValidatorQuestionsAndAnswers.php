<?php
//при сохранении теста проверяет всё ли заполнено у вопросов и ответов к ним
<<<<<<< HEAD:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
class ValidatorQuestionsAndAnswersOnCreate extends CValidator {
=======
class ValidatorQuestionsAndAnswers extends CValidator {
>>>>>>> 30d078f57814bbd04dac93a7c353522de6580620:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php



    protected function ReadMapQuestionsAnswersErr($MapQuestionsAnswersErr){
        $questionsErr=array_keys($MapQuestionsAnswersErr);
        $errMessage=array();
        foreach($questionsErr as $questionErr){
<<<<<<< HEAD:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
            $errMessage[]= "Вопрос: ".($questionErr+1).", Ответы: ".implode(", ", array_values($MapQuestionsAnswersErr[$questionErr]));
=======
            $errMessage[]= "Вопрос: ".($questionErr).", Ответы: ".implode(", ", array_values($MapQuestionsAnswersErr[$questionErr]));
>>>>>>> 30d078f57814bbd04dac93a7c353522de6580620:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
        }
        return $errMessage;
    }

    protected function validateAttribute($object,$attribute)
    {

<<<<<<< HEAD:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
        if($object->scenario=='createTest')$listQuestions=$object->listQuestions;
        if($object->scenario=='updateTest')$listQuestions=$object->listUpdateQuestions;
=======
        $listQuestions = $object[$attribute];
>>>>>>> 30d078f57814bbd04dac93a7c353522de6580620:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php

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
<<<<<<< HEAD:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php

            foreach($question->answers as $an=>$answer){
                $answer->validate();
                foreach($answer->getErrors() as $attribute=>$errors){
                    forEach($errors as $err){
                        $resultAnswer[$attribute][$err][$qn+1][]=$an+1;
=======
            if(isset($question->answers)){
                foreach($question->answers as $an=>$answer){
                    $answer->validate();
                    foreach($answer->getErrors() as $attribute=>$errors){
                        forEach($errors as $err){
                            $resultAnswer[$attribute][$err][$qn+1][]=$an+1;
                            echo $attribute.$err.($qn+1).($an+1);
                        }
>>>>>>> 30d078f57814bbd04dac93a7c353522de6580620:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
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
<<<<<<< HEAD:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
                $mapQuestionsAnswersErr = array_values($mapErrKey[$errorDesc]);
=======
                $mapQuestionsAnswersErr = $mapErrKey[$errorDesc];
>>>>>>> 30d078f57814bbd04dac93a7c353522de6580620:protected/modules/test/validators/ValidatorQuestionsAndAnswers.php
                $this->addError($object,$attribute,$errorDesc."<br>".implode("<br>",$this->ReadMapQuestionsAnswersErr($mapQuestionsAnswersErr)));
            }
        }

    }

}