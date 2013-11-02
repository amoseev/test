<?php

/**
 * This is the model class for table "answers".
 *
 * The followings are the available columns in table 'answers':
 * @property integer $id
 * @property integer $fk_question
 * @property string $response
 * @property double $score
 *
 * The followings are the available model relations:
 * @property Questions $fkQuestion
 * @property Details[] $details
 */
class Answers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Answers the static model class
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
		return 'answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('score, response', 'required'),
            array('score', 'numerical'),
			array('fk_question', 'numerical', 'integerOnly'=>true),
			array('score', 'numerical'),
			array('response', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_question, response, score', 'safe', 'on'=>'search'),
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
			'fkQuestion' => array(self::BELONGS_TO, 'Questions', 'fk_question'),
			'details' => array(self::HAS_MANY, 'Details', 'fk_answer'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fk_question' => 'Fk Question',
			'response' => 'Вариант ответа',
			'score' => 'Балл',
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
		$criteria->compare('fk_question',$this->fk_question);
		$criteria->compare('response',$this->response,true);
		$criteria->compare('score',$this->score);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}