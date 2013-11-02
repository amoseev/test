<?php
$this->breadcrumbs=array(
	'Tests'=>array('index'),'Title1'
	//$model->title=>array('view','id'=>$model->id)
);

?>

<h2><?php echo $fullTest->title; ?></h2>


<?php /* $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$fullTest,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'category',
		'statuse',
     //   'questions',
	),
)); */?>

 
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'pass-test-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	
<?php 
        $newPassing = new Passings();   
        foreach($fullTest->questions as $question)
         {
            echo $question->statement;
            
            $newDetail = new Details;
            $newPassing->details[] = $newDetail;
            echo $form->radioButtonList($newDetail,'fk_answer', CHtml::listData($question->answers,'id', 'response'),
                 array(  
                        //'id'=>$question->id,
                        'name'=>$question->id,
                        // 'checked'=>'checked',
                        'uncheckValue'=>null
                 )
            );  
                
         }
   ?>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Отправить',
        )); ?>
	</div>
    

<?php $this->endWidget(); ?>
<!--  --!>

<?php

?>
