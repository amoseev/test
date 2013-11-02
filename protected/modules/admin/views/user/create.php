<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_USERS=>array('index'),
	MyMenuLabels::MENU_CREATE_USER,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_LIST_USERS,'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_MANAGE_USERS,'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1><?php
	MyMenuLabels::MENU_CREATE_USER
?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>