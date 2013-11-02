<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
	array('label'=>MyMenuLabels::MENU_TEST_MANAGE_TESTS,'url'=>Yii::app()->createUrl('test/tests/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>
 <?php   Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('test.assets')).'/js/CreatePassing.js' , CClientScript::POS_HEAD); ?>

<h1><? echo $model->fullTest->title ?></h1>

<?php echo $this->renderPartial('_formPassing', array('model'=>$model,)); ?>