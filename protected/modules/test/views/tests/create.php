<?php

$this->breadcrumbs=array(
	MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
	MyMenuLabels::MENU_TEST_CREATE_TESTS,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
	array('label'=>MyMenuLabels::MENU_TEST_MANAGE_TESTS,'url'=>Yii::app()->createUrl('test/tests/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1><? echo MyMenuLabels::MENU_TEST_CREATE_TESTS ?></h1>

<?php echo $this->renderPartial('_form_full_test', array('model'=>$model)); ?>