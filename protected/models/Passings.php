<?php

/**
 * This is the model class for table "passings".
 *
 * The followings are the available columns in table 'passings':
 * @property integer $id
 * @property integer $fk_user
 * @property integer $fk_test
 * @property double $result_sum
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Details[] $details
 * @property Users $fkUser
 * @property Tests $fkTest
 */
class Passings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Passings the static model class
	 */
     
    public $details=array(); 
    public $fullTest=array(); 
    public $scoreMap=array(); 
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'passings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fk_user, fk_test', 'required'),
			array('fk_user, fk_test', 'numerical', 'integerOnly'=>true),
			array('result_sum', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_user, fk_test, result_sum, date', 'safe', 'on'=>'search'),
            array('details', 'test.validators.ValidatorFullAnswers'),
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
			'details' => array(self::HAS_MANY, 'Details', 'fk_passings'),
			//'user' => array(self::BELONGS_TO, 'Users', 'fk_user'), //Yii:app()->user
			'test' => array(self::BELONGS_TO, 'Tests', 'fk_test'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fk_user' => 'Пользователь',
			'fk_test' => 'Тест (ID)',
			'result_sum' => 'Сумма баллов за тест',
			'date' => 'Дата',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('fk_user',$this->fk_user);
		$criteria->compare('fk_test',$this->fk_test);
		$criteria->compare('result_sum',$this->result_sum);
		$criteria->compare('date',$this->date,true);

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
                $this->date=date('Y-m-d H:i:s');
                   //СУММА БАЛЛОВ 
                   
                $result_sum=0;
                foreach($this->details as $i=>$detail) {
                    $result_sum+=$this->scoreMap["$detail"];
                }
                $this->result_sum=$result_sum;
            }
            return true;
        }
        else
            return false;
    }
    
    
    protected function afterSave()
    {
        parent::afterSave();
        
        foreach($this->details as $i=>$idAnswers)
        {       
            $detail=new Details();
            $detail->date=date('Y-m-d H:i:s');
            $detail->fk_user = $this->fk_user;
            $detail->fk_answer=$idAnswers;
            $detail->fk_passings = $this->id;
            $detail->save();//*/
        }   
    }
    
    
                        
}