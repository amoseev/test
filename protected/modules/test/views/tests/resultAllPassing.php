<?php
/**
 * Created by JetBrains PhpStorm.
 * User: артем
 * Date: 03.11.13
 * Time: 16:20
 * To change this template use File | Settings | File Templates.
 */
$this->breadcrumbs=array(
    MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
);

$this->menu=array(
    array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
);
?>
    <h3>Пользователь: <? echo Yii::app()->user->name ?></h3>

    <?  foreach($model as $modelOne){ ?>
             <h5>Тест: <? echo $modelOne->test->title ?></h5>
             <h5>Дата: <? echo $modelOne->date ?></h5>
            <?php
                $flagShowKey=false;
                foreach($modelOne->test->keys as $key){
                    if($modelOne->result_sum > $key->bottom_val && $modelOne->result_sum < $key->top_val){
                        echo $this->renderPartial('_form_result_passing', array('key'=>$key,'result_sum'=>$modelOne->result_sum));
                        $flagShowKey=true;
                    }
                }
                if(!$flagShowKey) echo "<span class='alert-error'>Ниодин ключ к тесту не подошел для полученной суммы баллов: ".$modelOne->result_sum."</span>";
            //echo $this->renderPartial('_form_result_passing.php', array('model'=>$model,)); ?>

    <?  }?>



