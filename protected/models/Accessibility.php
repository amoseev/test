<?php

/**
 * This is the model class for table "accessibility".
 *
 * The followings are the available columns in table 'accessibility':
 * @property integer $id
 * @property integer $fk_user
 * @property integer $fk_test
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Users $fkUser
 * @property Tests $fkTest
 */
class Accessibility extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Accessibility the static model class
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
		return 'accessibility';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'required'),
			array('fk_user, fk_test', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_user, fk_test, date', 'safe', 'on'=>'search'),
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
			'fk_user' => 'Fk User',
			'fk_test' => 'Fk Test',
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
		$criteria->compare('fk_test',$this->fk_test);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}