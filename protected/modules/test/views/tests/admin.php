<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_TEST_LIST_TESTS=>array('index'),
	MyMenuLabels::MENU_TEST_MANAGE_TESTS,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_TEST_LIST_TESTS,'url'=>Yii::app()->createUrl('test/tests/index')),
	array('label'=>MyMenuLabels::MENU_TEST_CREATE_TESTS,'url'=>Yii::app()->createUrl('test/tests/create'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tests-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><? echo MyMenuLabels::MENU_TEST_MANAGE_TESTS?></h1>

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
	'id'=>'tests-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'description',
		'category',
		'statuse',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}'
		),
	),
)); ?>
