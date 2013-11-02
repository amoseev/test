<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $id
 * @property integer $fk_test
 * @property string $statement
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Details[] $details
 * @property Tests $fkTest
 */
class Questions extends CActiveRecord
{
    public $title;
    public $mapUpdateAnswers = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Questions the static model class
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
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('statement, answers',  'required'),
  			array('fk_test', 'numerical', 'integerOnly'=>true),
			array('statement', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, fk_test, statement', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answers', 'fk_question'),
		//	'details' => array(self::HAS_MANY, 'Details', 'fk_question'),
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
			'statement' => 'Вопрос',
            'answers' => 'Ответы на Вопрос',
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
		$criteria->compare('statement',$this->statement,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
	public function getAnswers()//может удалить:? не помню зачем делал)
	{  
        $res=CHtml::listData($this->answers,'id', 'response');
        return $res;
	}


    protected function afterSave()
    {
       // echo 'into save question';
      //  exit;

        parent::afterSave();

        $countNewA = count ( $this->mapUpdateAnswers );
        $countLastA = count( $this->answers ) ;

        if($this->scenario=='createTest'){
            foreach($this->answers as $a_number=>$answer)
            {
                $answer->scenario=$this->scenario;
                $answer->fk_question = $this->id;
                $answer->save();
            }
        }


        if( $this->scenario=='updateTest') {
                if( $countLastA == $countNewA ){
                	for ($i = 0; $i < $countLastA; $i++) {
                		$this->answers[$i]->response = $this->mapUpdateAnswers[$i]['response'] ;
                		$this->answers[$i]->score = $this->mapUpdateAnswers[$i]['score'] ;
                 		$this->answers[$i]->save();
                    }
                }
                if( $countNewA > $countLastA ){
                    for ($i = 0; $i < $countLastA; $i++) {
                		$this->answers[$i]->response = $this->mapUpdateAnswers[$i]['response'] ;
                		$this->answers[$i]->score = $this->mapUpdateAnswers[$i]['score'] ;
                		$this->answers[$i]->save();
             	    }
                	for ($i = $countLastA ; $i < $countNewA; $i++) {
                        $answer=new Answers();
                        $answer->fk_question = $this->id;
                        $answer->response=$this->mapUpdateAnswers[$i]['response'];
                        $answer->score=$this->mapUpdateAnswers[$i]['score'];
                        $answer->save();
                	}
                }
                if( $countNewA < $countLastA ){
                	for ($i = 0; $i < $countNewA; $i++) {
                		$this->answers[$i]->response = $this->mapUpdateAnswers[$i]['response'] ;
                		$this->answers[$i]->score = $this->mapUpdateAnswers[$i]['score'] ;
                		$this->answers[$i]->save();
                	}
                	for ($i = $countNewA; $i < $countLastA; $i++) {
                		$this->answers[$i]->delete();
                	}
                }  
        }


       
    }    
    
}