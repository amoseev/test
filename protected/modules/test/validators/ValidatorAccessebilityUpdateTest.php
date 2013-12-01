<?php
/**
 * Created by JetBrains PhpStorm.
 * User: артем
 * Date: 01.12.13
 * Time: 19:21
 * To change this template use File | Settings | File Templates.
 */


	 class ValidatorAccessebilityUpdateTest extends CValidator{


         protected function validateAttribute($object,$attribute)
         {
             $listUpdateQuestions = $object->listUpdateQuestions;
             $listQuestions = $object->listQuestions;
             $countPassings = $object->getCountPassings();
             if($countPassings==0) return;

             if(count($listUpdateQuestions)!==count($listQuestions)){
                 $this->addError($object,$attribute,'Нельзя изменять число вопросов к тестам, на которые уже есть ответы');
                 return;
             }

             $listQuestionsWithWrongCountAnswers = array();
             foreach($listUpdateQuestions as $i=>$question){
                 if(count($question->answers) !== count($listQuestions[$i]->answers) )$listQuestionsWithWrongCountAnswers[] = 'Вопрос: '. ($i+1). ';  Ожидалось ответов: '. count($listQuestions[$i]->answers);
             }

             if(!empty($listQuestionsWithWrongCountAnswers))
                 $this->addError($object,$attribute,'Нельзя изменять число вариантов ответа к тестам, на которые уже есть ответы'.'<br>'.implode("<br>",$listQuestionsWithWrongCountAnswers));
         }
     }

?>