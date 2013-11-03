<?php
	 class ValidatorFullAnswers extends CValidator{
        
        //public $details = null;
        protected $fullTest = null;
         
        protected function validateAttribute($object,$attribute)
        {
            $details=$object->details;
            $fullTest=$object->fullTest;
            //echo var_dump($fullTest);exit;
            foreach($fullTest->questions as $i=>$question)//тут $i - номера вопросов по порядку на странице ( для вопросов с fk=20 отсчет тоже будет с 1 и это норм)
            {
               if(!isset($details[$question->id]))
               {
                    $empty_questions[]=$i+1;
               }
            }
                if(!empty($empty_questions))
    			$this->addError($object,$attribute,'Необходимо ответить на вопрос(ы): '.implode(", ", $empty_questions));
    		} 
}
 
?>