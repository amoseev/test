<?php
    class ValidatorTest extends CValidator {

    //protected $listUpdateQuestions;
    protected $listUpdateKeys;


    protected function validateAttribute($object,$attribute)
    {
        //$listUpdateQuestions = $object->listUpdateQuestions;
        $listUpdateKeys = $object->listUpdateKeys;

        $this->addError($object,$attribute,'Необходимо !!!!!!!!!!!!!!!:');
        $this->addError($object,$attribute,'22');
        echo var_dump($object);
       /* $details=$object->details;
        $fullTest=$object->fullTest;
        foreach($fullTest->questions as $i=>$question)//тут $i - номера вопросов по порядку на странице ( для вопросов с fk=20 отсчет тоже будет с 1 и это норм)
        {
           if(!isset($details[$question->id]))
           {
                $empty_questions[]=$i+1;
           }
        }
            if(!empty($empty_questions))
            $this->addError($object,$attribute,'Необходимо ответить на вопрос(ы): '.implode(", ", $empty_questions));
            //*/
    }

}
//*/
?>