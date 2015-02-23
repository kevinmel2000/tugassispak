<?php
/* @var $this FisProjectController */
/* @var $data Fis */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('project_name')); ?>:</b>
	<?php echo CHtml::encode($data->project_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_fis')); ?>:</b>
	<?php echo CHtml::encode($data->id_fis); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('and_method')); ?>:</b>
	<?php echo CHtml::encode($data->and_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('or_method')); ?>:</b>
	<?php echo CHtml::encode($data->or_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('implication')); ?>:</b>
	<?php echo CHtml::encode($data->implication); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aggregation')); ?>:</b>
	<?php echo CHtml::encode($data->aggregation); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('defuzzification')); ?>:</b>
	<?php echo CHtml::encode($data->defuzzification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>