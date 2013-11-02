<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_USERS=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_LIST_USERS,'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_CREATE_USER,'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_UPDATE_USER,'url'=>array('update','id'=>$model->u_id), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_DELETE_USER,'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->u_id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->checkAccess('admin')),
	array('label'=>MyMenuLabels::MENU_MANAGE_USERS,'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1><?php echo MyMenuLabels::MENU_VIEW_USER ?>:<?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'u_id',
		'name',
		'password_hash',
		'salt',
		'email',
		'reg_date',
		'last_update',
		'role',
		'info',
	),
)); ?>
