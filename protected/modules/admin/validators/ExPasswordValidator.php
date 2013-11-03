<?php
/**
 * Created by JetBrains PhpStorm.
 * User: артем
 * Date: 03.11.13
 * Time: 17:19
 * To change this template use File | Settings | File Templates.
 */

class ExPasswordValidator extends CValidator{

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
                $this->addError($object,$attribute,'ERROR unexpected user role ='.$userRole);

        }
        if(!empty($message))
            $this->addError($object,$attribute,$message);
    }
}