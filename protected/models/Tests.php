<?php

/**
 * This is the model class for table "tests".
 *
 * The followings are the available columns in table 'tests':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $category
 * @property integer $statuse
 *
 * The followings are the available model relations:
 * @property Accessibility[] $accessibilities
 * @property Passings[] $passings
 * @property Questions[] $questions
 * @property TestResults[] $testResults
 */
class Tests extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tests the static model class
	 */
    
    public $listQuestions=array(); 

    public $listKeys=array(); 
    
    public $listUpdateQuestions=array(); 

    public $listUpdateKeys=array();
     
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            
			array('title, statuse, description', 'required'),
			array('statuse', 'numerical', 'integerOnly'=>true),
			array('title, category', 'length', 'max'=>64),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, category, statuse', 'safe', 'on'=>'search'),
           // array('listUpdateKeys,listUpdateQuestions', 'required','on'=>'updateTest', ),
            //array('listKeys,listQuestions', 'required','on'=>'createTest', ), //включены в валидаторы отдельно
            array('listQuestions', 'test.validators.ValidatorQuestionsAndAnswers','on'=>'createTest', ),
            array('listKeys', 'test.validators.ValidatorKeys','on'=>'createTest', ),
            array('listUpdateKeys', 'test.validators.ValidatorKeys','on'=>'updateTest', ),
            array('listUpdateQuestions', 'test.validators.ValidatorQuestionsAndAnswers','on'=>'updateTest', ),
            array('listUpdateQuestions', 'test.validators.ValidatorAccessebilityUpdateTest','on'=>'updateTest', ),

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
			'accessibilities' => array(self::HAS_MANY, 'Accessibility', 'fk_test'),
			'passings' => array(self::HAS_MANY, 'Passings', 'fk_test'),
			'questions' => array(self::HAS_MANY, 'Questions', 'fk_test'),
			'keys' => array(self::HAS_MANY, 'Keys', 'fk_test'),
            //'answersQ' => array(self::HAS_MANY, 'Answers', 'questions_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'description' => 'Описание',
			'category' => 'Категория',
			'statuse' => 'Статус',
            'statement' => 'statement statement',
            'listUpdateKeys' => 'Ключи к тесту',
            'listUpdateQuestions' => 'Вопросы к тесту',
            'listKeys' => 'Ключи к тесту',
            'listQuestions' => 'Вопросы к тесту',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('statuse',$this->statuse);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


    protected function afterSave()
    {
        parent::afterSave();

        // Create Test
        //echo "after save test"; exit;
        if($this->scenario=='createTest' ){
           //'new questions';
            foreach($this->listQuestions as $q_number=>$question)
            {
                $question->scenario=$this->scenario;
                $question->fk_test = $this->id;
                //$question->statement=$questionElem['statement'];
                //$question->mapAnswers=$questionElem['answers'];
                $question->save();
            }
        }
        if($this->scenario=='createTest' ){
            //new keys
            foreach($this->listKeys as $key){
                //$key=new Keys();
                $key->scenario=$this->scenario;
                $key->fk_test = $this->id;
                //$key->bottom_val=$keyParams['bottom_val'];
                //$key->top_val=$keyParams['top_val'];
                //$key->description=$keyParams['description'];
                $key->save();
            }
        }



        // Update Test
        //echo update questions

//Если на тест уже есть результаты ответов, то позвляю изменять его только поправив баллы в существующем числе вопросов - ответов

        $countNewQ = count ( $this->listUpdateQuestions );
        $countLastQ = count( $this->listQuestions ) ;

       /// $this->addError($this,'sdf');


        if( $this->scenario=='updateTest'  ) {
                if( $countLastQ == $countNewQ ){
                    $isNeedRecalculateResultSum = $this->getNeedRecalculateResultSum();
                	for ($i = 0; $i < $countLastQ; $i++) {
                		$this->listQuestions[$i]->statement = $this->listUpdateQuestions[$i]['statement'] ;
                		$this->listQuestions[$i]->mapUpdateAnswers = $this->listUpdateQuestions[$i]['answers'] ;
                        $this->listQuestions[$i]->scenario=$this->scenario;
                        $this->listQuestions[$i]->save();

                        //$this->listQuestions[$i]->save(false);
                		//отключил валидацию при сохранении, т.к. уже была валидация в специальном валидаторе,
                        //а это решит проблему сохранения правильной модели вместо  не валидной модели . На бою можно опять сделать валидацию.
                        //TODO если у вопроса нету ответов, то будет ошибка. - исправил отключив повторную валидацию.
                    }
                    if($isNeedRecalculateResultSum)$this->recalculateResultSum();

                }

                if( $countNewQ > $countLastQ ){
                    for ($i = 0; $i < $countLastQ; $i++) {
                		$this->listQuestions[$i]->statement = $this->listUpdateQuestions[$i]['statement'] ;
                		$this->listQuestions[$i]->mapUpdateAnswers = $this->listUpdateQuestions[$i]['answers'] ;
                		$this->listQuestions[$i]->save();
             	    }
                	for ($i = $countLastQ ; $i < $countNewQ; $i++) {
                        $question=new Questions();
                        $question->fk_test = $this->id;
                        $question->statement=$this->listUpdateQuestions[$i]['statement'];
                        $question->answers=$this->listUpdateQuestions[$i]['answers'];
                        $question->save();
                	}
                }

                if( $countNewQ < $countLastQ ){
                	for ($i = 0; $i < $countNewQ; $i++) {
                		$this->listQuestions[$i]->statement = $this->listUpdateQuestions[$i]['statement'] ;
                		$this->listQuestions[$i]->mapUpdateAnswers = $this->listUpdateQuestions[$i]['answers'] ;
                		$this->listQuestions[$i]->save();
                	}
                	for ($i = $countNewQ; $i < $countLastQ; $i++) {
                		$this->listQuestions[$i]->delete();
                	}
                }  
        }

        //update keys
        $countNew = count ( $this->listUpdateKeys );
        $countLast = count( $this->listKeys ) ;
        if( $this->scenario=='updateTest'  ) {

                if( $countLast == $countNew ){
                	for ($i = 0; $i < $countLast; $i++) {
                		$this->listKeys[$i]['bottom_val'] = $this->listUpdateKeys[$i]['bottom_val'] ;
                		$this->listKeys[$i]['top_val'] = $this->listUpdateKeys[$i]['top_val'] ;
                		$this->listKeys[$i]['description'] = $this->listUpdateKeys[$i]['description'] ;
                		$this->listKeys[$i]->save();
                    }
                }
                if( $countNew > $countLast ){
                    for ($i = 0; $i < $countLast; $i++) {
                		$this->listKeys[$i]['bottom_val'] = $this->listUpdateKeys[$i]['bottom_val'] ;
                		$this->listKeys[$i]['top_val'] = $this->listUpdateKeys[$i]['top_val'] ;
                		$this->listKeys[$i]['description'] = $this->listUpdateKeys[$i]['description'] ;
                		$this->listKeys[$i]->save();
             	    }
                	for ($i = $countLast ; $i < $countNew; $i++) {
                        $key=new Keys();
                        $key->fk_test = $this->id;
                        $key->bottom_val=$this->listUpdateKeys[$i]['bottom_val'];
                        $key->top_val=$this->listUpdateKeys[$i]['top_val'];
                        $key->description=$this->listUpdateKeys[$i]['description'];                
                        $key->save();  
                	} 	  
                
                
                }
                if( $countNew < $countLast ){
                	for ($i = 0; $i < $countNew; $i++) {
                		$this->listKeys[$i]['bottom_val'] = $this->listUpdateKeys[$i]['bottom_val'] ;
                		$this->listKeys[$i]['top_val'] = $this->listUpdateKeys[$i]['top_val'] ;
                		$this->listKeys[$i]['description'] = $this->listUpdateKeys[$i]['description'] ;
                		$this->listKeys[$i]->save();
                	}
                	for ($i = $countNew; $i < $countLast; $i++) {
                		$this->listKeys[$i]->delete();
                	}
                }
              
        }

    }
        
    
    public function getCountPassings(){
        $id = $this->id;
        $sql = "SELECT count(*) FROM passings WHERE fk_test = :id";
        $res = Yii::app()->db->createCommand($sql)->bindParam(":id",$id,PDO::PARAM_INT)->queryScalar();
        $res = empty($res) ? 0 : (int) $res;
        return $res;
    }
    
    protected function getNeedRecalculateResultSum(){

        if(count($this->listUpdateQuestions) !== count($this->listQuestions) ) throw new Exception('Different count of questions');

        foreach($this->listUpdateQuestions as $i => $question ){
            foreach($question->answers as $j => $answer){
                if( $answer['score'] !== $this->listQuestions[$i]->answers[$j]['score'] ){
                    return true;
                }
            }
        }
        return false;
    }

    protected function recalculateResultSum(){
        $id = $this->id;
        $sql = "update passings p
                set   p.result_sum = (
                                        select sum(a.score) from  details d
                                        inner join answers a on (d.fk_answer = a.id)
                                        where d.fk_passings = p.id
                                     )
                where
                p.fk_test = :fk_test
                ;";
        $res = Yii::app()->db->createCommand($sql)->bindParam(":fk_test",$id,PDO::PARAM_INT)->execute();
        $res = empty($res) ? 0 : (int) $res;
        return $res;


    }
    
    
}