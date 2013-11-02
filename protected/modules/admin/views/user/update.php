<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_USERS=>array('index'),
	$model->name=>array('view','id'=>$model->u_id),
	MyMenuLabels::MENU_UPDATE_USER,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_LIST_USERS,'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_CREATE_USER,'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_VIEW_USER,'url'=>array('view','id'=>$model->u_id), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_MANAGE_USERS,'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1> <?php echo	MyMenuLabels::MENU_UPDATE_USER; ?> : <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>