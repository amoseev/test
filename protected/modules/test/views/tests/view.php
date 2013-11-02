<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Tests','url'=>array('index')),
	array('label'=>'Create Tests','url'=>array('create')),
	array('label'=>'Update Tests','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Tests','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tests','url'=>array('admin')),
);
?>

<h1>View Tests #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'category',
		'statuse',
	),
)); ?>
