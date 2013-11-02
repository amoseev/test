<?php

$this->breadcrumbs=array(
	MyMenuLabels::MENU_TEST_LIST_TESTS,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_TEST_CREATE_TESTS,'url'=>Yii::app()->createUrl('test/tests/create'), 'visible'=>Yii::app()->user->checkAccess('admin')),
	array('label'=>MyMenuLabels::MENU_TEST_MANAGE_TESTS,'url'=>Yii::app()->createUrl('test/tests/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1> <? echo MyMenuLabels::MENU_TEST_LIST_TESTS ?> </h1>
<?   $dataProvider->pagination->pageSize=30; ?>
<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',

)); ?>
