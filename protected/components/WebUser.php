<?php /*
class WebUser extends CWebUser
{
    /**  SOURCE: http://www.yiiframework.com/wiki/328/simple-rbac
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
  /*  public function checkAccess($operation, $params=array())
    {
        
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }

        if ($role === 'admin') {
            return true; // admin role has access to everything
        }
        // allow access if the operation request is the current user's role
     //  return ($operation === $role);
        return $res= array($operation,$params);
    }
}
	*/
?>
<?php
	class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}
?>