<?php

class TestsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	private $test_id;
    
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','createPassing','viewResult','resultPassing','resultAllPassing',/*DELETE*/'create','deleteKey'),
				'roles'=>array('guest'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 *//*
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    
	public function actionView2($id)
	{
		$this->render('view2',array(
			'model'=>$this->loadModel($id),
		));
	}*//*
    public function actionViewResult($passing)
	{
      echo 'passing  '.$passing;
      $passing_m = Passings::model()->findByPk($passing);
      echo var_dump($passing_m);
       exit();
    	$this->render('result',array(
			'model'=>$this->loadKeys($id),'result_sum'
		));
	}    */
    
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
     
     
     
     
    protected function getListPostKeys()
    {
            $listKeys=array();
            if(isset($_POST['Key'])){
                foreach($_POST['Key'] as $keyParams ){
                    $key = new Keys();
                    foreach($keyParams as $param=>$value){
                        $key[$param]=$value;
                    }
                    $listKeys[] = $key;
                }
            }else{
               // throw new CHttpException(400,'Invalid request. Empty list of keys');
            }
            return $listKeys;    
    } 
     
    protected function getPostQuestions()
    {
            $arrQuestions=array();
            if(  isset($_POST['Question'])  ){
                foreach($_POST['Question'] as $q_number=>$questionStatement ){

                    $question = new Questions();
                    $question->statement = $questionStatement;
                    if( isset($_POST['Answer'][$q_number])){
                        $arrAnswersForQuestion = array();
                        foreach($_POST['Answer'][$q_number] as $a_number=>$answerItem){//это чтобы нумерация была с нуля и пропускались удаленные ответы
                            if(isset($_POST['Answer'][$q_number][$a_number])){
                                $answer = new Answers();
                                $answer->score = $_POST['Answer'][$q_number][$a_number]['score'];
                                $answer->response = $_POST['Answer'][$q_number][$a_number]['response'];
                                $arrAnswersForQuestion[] = $answer;
                            }
                        }
                        $question->answers = $arrAnswersForQuestion;
                    }
                    $arrQuestions[] = $question;
                }
            }else{
                //throw new CHttpException(400,'Invalid request. Empty list of questions');
            }

            /*foreach($arrQuestions as $qn=>$question){
                echo "question:$qn  :".$question->statement."</br>";
                echo "count answers:".count($question->answers)."</br>";
                if(isset($question->answers))foreach($question->answers as $answer) echo "answer:".($answer->response)."   ".($answer->score)."</br>";
            };//*/


            return $arrQuestions;
    }     
     
     
     
     
	public function actionCreate()
	{
	       
		$model = new Tests;
        $model -> setScenario('createTest');

        // Uncomment the following line if AJAX validation is needed
       // $this->performAjaxValidation($model);

		if(isset($_POST['Tests']))
		{

            $model->attributes=$_POST['Tests'];
            
            $model->listQuestions = $this->getPostQuestions() ;
            
            $model->listKeys=$this->getListPostKeys();

			if($model->save())//!! редиректить на редактирование
            {
                $this->redirect(array('update','id'=>$model->id));
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
     
	public function actionUpdate($id)
	{
	    $model = $this->loadFullTest($id);
		$model->listKeys = $model->keys; //$this->loadKeys($id);
        $model->listQuestions = $model->questions;
		$model -> setScenario('updateTest');
        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tests']))//обновляем все поля. смотрим что было, а что новое
		{

            $model->attributes=$_POST['Tests'];
  
            /*foreach($model->questions as $q_number=>$question ){
                $model->listQuestions[$q_number] =$question;
                $model->listQuestions[$q_number]->mapAnswers = $question->answers;
            }//*/

            $model->listUpdateQuestions = $this->getPostQuestions();
                              
            $model->listUpdateKeys=$this->getListPostKeys();



           if($model->save()){
               $this->redirect(array('update','id'=>$model->id));
           }else{
               $model->listQuestions = $model->listUpdateQuestions;
               $model->listKeys = $model->listUpdateKeys;
           }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted           
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Tests');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tests('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tests']))
			$model->attributes=$_GET['Tests'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Tests::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tests-form')
		{
			echo CActiveForm::validate($model);
 			Yii::app()->end();
		}
	}
    //*********************************************************************//
  /*	public function loadKey()
	{
		$model=Keys::model()->with(array(
            'testResults'=>array(
                'condition'=>'keys.fk_test=1',
            ),     
        ))->findAll();
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	} */
     public function actionCreatePassing($id)
	{
	    $model=new Passings;
	    $fullTest=$this->loadFullTest($id);
        $model->fullTest=$fullTest;
        $model->scoreMap=$this->createScoreMap($fullTest);
        
		if(isset($_POST['Passings']))
		{
			$model->attributes=$_POST['Passings'];
            $model->fk_test=$id;
            $model->fk_user=Yii::app()->user->id;//если пользователь не войдет - будет ошибка

            if($model->save()){
                $this->redirect(array('resultPassing','id'=>$model->id));
            }
		}

	   $this->render('createPassing',array('model'=>$model,));
	}

    public function actionResultPassing($id)
    {
        $model = Passings::model()->with('test.keys')->findByPk($id);
        $this->render('resultPassing',array('model'=>$model,));
    }


    public function actionResultAllPassing()
    {
        $userID = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = 'fk_user='.$userID.'';
        $model = Passings::model()->with('test.keys')->findAll($criteria);
        $this->render('resultAllPassing',array('model'=>$model,));
    }
    
    public function actionDeleteKey($keyID)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
            echo 1;
            exit();
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

    
 	public function loadKeys($id)
	{
		$model=Keys::model()->findAll('fk_test=:fk_test', array(':fk_test'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $model;
	}   
    
       
    public function loadFullTest($id)
	{ ///* проверить запрос который делается
		$model=Tests::model()->with('keys','questions','questions.answers')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function createScoreMap($fullTest)
	{
        $scoreMap=array();
        foreach($fullTest->questions as $question)
            {
                foreach($question->answers as $answer)
                    {
                         $scoreMap[$answer->id]=$answer->score;
                    }
            }
        return $scoreMap;
	}
}
