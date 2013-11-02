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
 
 
 
 
 
 
 
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
     
    const ROLE_ADMIN = 'admin';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

        
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,role', 'required'),
            array('name', 'unique'),
            //array('email', 'email'),
			array('name', 'length', 'max'=>50),
			array('password_hash, salt', 'length', 'max'=>64),
			array('email, role', 'length', 'max'=>30),
			array('info', 'length', 'max'=>535),
			array('last_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('u_id, name, password_hash, salt, email, reg_date, last_update, role, info', 'safe', 'on'=>'search'),
             //          array('password_hash', 'ExPasswordValidator','userRole'=>'name'), 
            
            //'boundAttributeValue'=>'success','password_hash'=>'Required field'),

            array('password_hash,email', 'ExPasswordValidator','userRole'=>'role',),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'u_id' => 'ID',
			'name' => 'Пользователь',
			'password_hash' => 'Пароль',
			'salt' => 'Salt',
			'email' => 'E-mail',
			'reg_date' => 'Reg Date',
			'last_update' => 'Last Update',
			'role' => 'Роль пользователя',
			'info' => 'Иформация о пользователе',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('u_id',$this->u_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('password_hash',$this->password_hash,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('reg_date',$this->reg_date,true);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('info',$this->info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->salt=UserIdentity::blowfishSalt();
                $this->password_hash=crypt($this->password_hash,$this->salt);
                $this->reg_date=$this->last_update=date('Y-m-d H:i:s');
            }
            else
                $this->last_update=date('Y-m-d H:i:s');
            return true;
        }
        else
            return false;
    }
    


 
    
}