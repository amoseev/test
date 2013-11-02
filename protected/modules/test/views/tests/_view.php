<div class="view">

	<b><?php //echo CHtml::encode($data->getAttributeLabel('title')); ?></b>
	<?php echo CHtml::link(CHtml::encode($data->title),array('createPassing','id'=>$data->id)); ?>
	<br />
<!-- <? // COMMENT BELOW !!!!?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('statuse')); ?>:</b>
	<?php echo CHtml::encode($data->statuse); ?>
	<br />
 -->

</div>