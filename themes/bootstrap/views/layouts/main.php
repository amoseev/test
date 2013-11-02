<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>myMenuLabels::MENU_TESTS, 'url'=>array('/test/tests/index')),
                array('label'=>myMenuLabels::MENU_USERS, 'url'=>array('/admin/user/index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),            
                array('label'=>myMenuLabels::MENU_CONTACTS, 'url'=>array('/site/contact')),
                array('label'=>myMenuLabels::MENU_LOGIN, 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>myMenuLabels::MENU_LOGOUT.'('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

                //array('label'=>myMenuLabels::MENU_TESTS, 'url'=>array('/test/tests/index'), 'visible'=>Yii::app()->user->checkAccess('moderator')),
          
            ),//'url'=>array(Yii::app()->createUrl('admin/index'))
            // Yii::app()->user->checkAccess('index')
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
            'homeLink' => false
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
