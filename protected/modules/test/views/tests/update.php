<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
	MyMenuLabels::MENU_TEST_UPDATE_TESTS,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
	array('label'=>MyMenuLabels::MENU_TEST_CREATE_TESTS,'url'=>Yii::app()->createUrl('test/tests/create'), 'visible'=>Yii::app()->user->checkAccess('admin')),
	array('label'=>MyMenuLabels::MENU_TEST_MANAGE_TESTS,'url'=>Yii::app()->createUrl('test/tests/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
    array('label'=>MyMenuLabels::MENU_TEST_CREATE_PASSING,'url'=>Yii::app()->createUrl('test/tests/createPassing',array('id'=> $model->id) ) ),
);
?>

<h1><?php echo MyMenuLabels::MENU_TEST_UPDATE_TESTS; ?> <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form_full_test',array('model'=>$model)); ?>