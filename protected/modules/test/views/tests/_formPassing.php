<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'passing-form',
	'enableAjaxValidation'=>false,
)); ?>

 <? //	<p class="help-block">Fields with <span class="required">*</span> are required.</p> ?>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'fk_user',array('class'=>'span5','maxlength'=>64)); ?>

	<?php// echo $form->textFieldRow($model,'fk_test',array('class'=>'span5','maxlength'=>64)); ?>

	<?php //echo $form->textFieldRow($model,'result_sum',array('class'=>'span5','maxlength'=>64)); ?>

<?php
         echo "<br>";
         $i=0;
         foreach($model->fullTest->questions as $i=>$question)
         {  
            $i_p1=$i+1;
            echo "#$i_p1  ".$question->statement;
            $fk_i=$question->id;
            echo $form->RadioButtonList($model,"details[$fk_i]", 
            CHtml::listData($question->answers,'id', 'response'),
                 array(  
                   'uncheckValue'=>null,
                   'checked'=>true,
                 )
            );  
         }
?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Подвердить' ,
		)); ?>
	</div>

<?php $this->endWidget(); ?>
