<?php
/**
 * Created by JetBrains PhpStorm.
 * User: артем
 * Date: 24.10.13
 * Time: 0:30
 * To change this template use File | Settings | File Templates.
 */

class ValidatorKeys extends CValidator {

    protected function validateAttribute($object,$attribute)
    {
        // if($object->scenario=='createTest')$listKeys=$object->listKeys;
        // if($object->scenario=='updateTest')$listKeys=$object->listUpdateKeys;
        $listKeys=$object[$attribute];

        if($this->isEmpty($listKeys)){
            $this->addError($object,$attribute,'Необходимо заполнить Ключи к тесту');
            return;
        }

        $result=array();
        foreach($listKeys as $kn=>$key){
            $key->validate();
            foreach($key->getErrors() as $attribute=>$errors){
                forEach($errors as $err){
                    $result[$attribute][$err][]=$kn+1;
                }
            }
        }

        foreach($result as $mapErrKey){
            $arrErrors = array_keys($mapErrKey);
            foreach($arrErrors as $errorDesc){
                $arrQuestionsErr = array_values($mapErrKey[$errorDesc]);
                $this->addError($object,$attribute,$errorDesc." Ключи: ".implode(", ", $arrQuestionsErr));
            }
        }

    }

}