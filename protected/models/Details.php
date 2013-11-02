<?php

/**
 * This is the model class for table "details".
 *
 * The followings are the available columns in table 'details':
 * @property integer $id
 * @property integer $fk_user
 * @property integer $fk_question
 * @property integer $fk_answer
 * @property integer $fk_passings
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Users $fkUser
 * @property Questions $fkQuestion
 * @property Answers $fkAnswer
 * @property Passings $fkPassings
 */
class Details extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Details the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date,fk_user, fk_answer, fk_passings', 'required'),
			array('fk_user,  fk_answer, fk_passings', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_user,  fk_answer, fk_passings, date', 'safe', 'on'=>'search'),
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
			'fkUser' => array(self::BELONGS_TO, 'Users', 'fk_user'),
			//'fkQuestion' => array(self::BELONGS_TO, 'Questions', 'fk_question'),
			'fkAnswer' => array(self::BELONGS_TO, 'Answers', 'fk_answer'),
			'fkPassings' => array(self::BELONGS_TO, 'Passings', 'fk_passings'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fk_user' => 'Fk User',
		//	'fk_question' => 'Fk Question',
			'fk_answer' => 'Fk Answer',
			'fk_passings' => 'Fk Passings',
			'date' => 'Date',
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
	//	$criteria->compare('fk_question',$this->fk_question);
		$criteria->compare('fk_answer',$this->fk_answer);
		$criteria->compare('fk_passings',$this->fk_passings);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}