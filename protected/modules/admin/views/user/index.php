<?php
$this->breadcrumbs=array(
	MyMenuLabels::MENU_USERS,
);

$this->menu=array(
	array('label'=>MyMenuLabels::MENU_CREATE_USER,'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
	array('label'=>MyMenuLabels::MENU_MANAGE_USERS,'url'=>Yii::app()->createUrl('admin/user/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
);
?>

<h1><?php
	echo MyMenuLabels::MENU_USERS;
?></h1>
<?php /*$this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); //*/ ?>
<?php
$gridDataProvider=$dataProvider;
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'filter'=>$model,
    'template'=>"{summary}{items}{pager}",
    'enablePagination' => true,
    'columns'=>array(
        array('name'=>'u_id', 'header'=>'№'),
        array('name'=>'name', 'header'=>'Пользователь'),
        array('name'=>'role', 'header'=>'Права'),
        array('name'=>'info', 'header'=>'Информация'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'template'=>'{update}{view}{delete}',
               'buttons'=>array(                
                    'delete' => array
                    (
                        //'label'=>'Send an e-mail to this user',
                        //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                        //'visible'=>'Yii::app()->user->checkAccess("admin")',
                        'visible'=>function($row, $data) {
                                return Yii::app()->user->checkAccess('admin') ;
                            }
                    ),
                ) 
        ),
    ),
)); ?>
<?php

?>



