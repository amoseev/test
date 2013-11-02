

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'user-form', 
    'enableAjaxValidation'=>false, 
)); ?>

    <p class="help-block">Поля, отмеченные <span class="required">*</span>, обязательны для заполнения</p> 

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->dropDownListRow($model,'role',array('admin'=>'admin','moderator'=>'moderator','user'=>'user'),array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php  echo $form->passwordFieldRow($model,'password_hash',array('class'=>'span5','maxlength'=>64)); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>30)); ?>

 <?php echo $form->textAreaRow($model, 'info', array('class'=>'span8', 'rows'=>5)); ?>
    
    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'type'=>'primary', 
            'label'=>$model->isNewRecord ? 'Create' : 'Save', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>