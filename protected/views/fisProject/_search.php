<?php
/* @var $this FisProjectController */
/* @var $model Fis */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'project_name'); ?>
		<?php echo $form->textField($model,'project_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_fis'); ?>
		<?php echo $form->textField($model,'id_fis'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'and_method'); ?>
		<?php echo $form->textField($model,'and_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'or_method'); ?>
		<?php echo $form->textField($model,'or_method'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'implication'); ?>
		<?php echo $form->textField($model,'implication'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aggregation'); ?>
		<?php echo $form->textField($model,'aggregation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'defuzzification'); ?>
		<?php echo $form->textField($model,'defuzzification'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->