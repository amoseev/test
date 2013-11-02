<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form TbActiveForm */

$this->pageTitle=Yii::app()->name .' - '. MyMenuLabels::MENU_CONTACTS;
$this->breadcrumbs=array(
	MyMenuLabels::MENU_CONTACTS,
);
?>

<h1><?php   echo	MyMenuLabels::MENU_CONTACTS;?></h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'alerts'=>array('contact'),
    )); ?>

<?php else: ?>

<p>
Если у вас есть предложения или вопросы, пожалуйста заполните форму для связи с нами. Спасибо.
</p>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны к заполнению</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('1')); ?>

    <?php echo $form->textFieldRow($model,'email'); ?>

    <?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'class'=>'span8')); ?>

	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->captchaRow($model,'verifyCode',array(
            'hint'=>'Пожалуйста, введите код подтверждения на картинке выше',
        )); ?>
	<?php endif; ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton',array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Отправить',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>