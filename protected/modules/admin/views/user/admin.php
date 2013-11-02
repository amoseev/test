<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_USERS=>array('index'),
	MyMenuLabels::MENU_MANAGE,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_LIST_USERS,'url'=>array('index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_CREATE_USER,'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление пользователями</h1>

<p>
Вы можете пользоваться операторами сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале любого поля для более гибкого поиска.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'template'=>'{items} {pager}',
	'columns'=>array(
		'u_id',
		'name',
		'email',
		'reg_date',

		//'last_update',
		'role',
		'info',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
