<?php
/**
 * Created by JetBrains PhpStorm.
 * User: артем
 * Date: 02.11.13
 * Time: 22:34
 * To change this template use File | Settings | File Templates.
 */

$this->breadcrumbs=array(
    MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
);

$this->menu=array(
    array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
    array('label'=>MyMenuLabels::MENU_TEST_LIST_PASSINGS,'url'=>Yii::app()->createUrl('test/tests/resultAllPassing'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1>Тест: <? echo $model->test->title ?></h1>

<h3>Пользователь: <? echo Yii::app()->user->name ?></h3>
<h5>Дата: <? echo $model->date ?></h5>
<?php
    $countResults=0;
    foreach($model->test->keys as $key){
        if($model->result_sum > $key->bottom_val && $model->result_sum < $key->top_val){
            $countResults=$countResults+1;
            echo $this->renderPartial('_form_result_passing', array('key'=>$key,'result_sum'=>$model->result_sum));
        }
    }
    if($countResults==0){
        echo "No accessbly keys";
    }//echo $this->renderPartial('_form_result_passing.php', array('model'=>$model,)); ?>








