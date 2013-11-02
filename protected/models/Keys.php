<?php

/**
 * This is the model class for table "keys".
 *
 * The followings are the available columns in table 'keys':
 * @property integer $id
 * @property integer $fk_test
 * @property double $bottom_val
 * @property double $top_val
 * @property string $short_description
 * @property string $description
 *
 * The followings are the available model relations:
 * @property Tests $fkTest
 */
class Keys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Keys the static model class
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
		return 'keys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('bottom_val,top_val,description', 'required'),
            array('bottom_val', 'compare', 'compareAttribute'=>'top_val','operator' => '<','message'=>'Минимальный балл должен быть меньше Максиального.'),
			array('fk_test', 'numerical', 'integerOnly'=>true),
			array('bottom_val, top_val', 'numerical'),
			array('short_description', 'length', 'max'=>64),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_test, bottom_val, top_val, short_description, description', 'safe', 'on'=>'search'),
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
			'fkTest' => array(self::BELONGS_TO, 'Tests', 'fk_test'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fk_test' => 'Fk Test',
			'bottom_val' => 'Минимальный балл',
			'top_val' => 'Максимальный балл',
			'short_description' => 'Short Description',
			'description' => 'Описание',
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
		$criteria->compare('fk_test',$this->fk_test);
		$criteria->compare('bottom_val',$this->bottom_val);
		$criteria->compare('top_val',$this->top_val);
		$criteria->compare('short_description',$this->short_description,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}