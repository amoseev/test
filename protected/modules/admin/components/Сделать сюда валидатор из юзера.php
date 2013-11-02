<?php
	 class ExPasswordValidator extends CRequiredValidator{
        
        public $userRole = null;
   
        protected function validateAttribute($object,$attribute)
        {
           $userRole = $object->role;
           $pass=$object->$attribute;
     		switch($userRole)
            {
			case 'admin':
                if($this->isEmpty($pass))
                   $message=$this->message!==null?$this->message:Yii::t('yii','Необходим {attribute} для '.$userRole);
				break;
			case 'moderator':
                if($this->isEmpty($pass))
                   $message=$this->message!==null?$this->message:Yii::t('yii','Необходим {attribute} пароль для '.$userRole);
				break;
			case 'user':
				break;                
    		default:
				$this->addError($object,$attribute,'user role ERROR='.$userRole);
     
            }
        if(!empty($message))
			$this->addError($object,$attribute,$message);
		}            
}
 
?>