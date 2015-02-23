<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_name'); ?>
		<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'user_name'); ?>
	</div>

    <?php if($model->isNewRecord): ?>
        <div class="row">
            <?php echo $form->labelEx($model,'user_passwd'); ?>
            <?php echo $form->passwordField($model,'user_passwd',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'user_passwd'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'reTypePasswd'); ?>
            <?php echo $form->passwordField($model,'reTypePasswd',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'reTypePasswd'); ?>
        </div>
    <?php endif; ?>
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_level_id'); ?>
		<?php echo $form->dropDownList(
                $model,
                'user_level_id',
                CHtml::listData(UserLevel::model()->findAll(), 'id', 'name'),
                NULL
                ); 
        ?>
        
		<?php echo $form->error($model,'user_level_id'); ?>
	</div>
    
    
    <?php if(!$model->isNewRecord): ?>
        </br>
        <div class="row">
            <p class="note">Optional</p>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'newPasswd'); ?>
            <?php echo $form->passwordField($model,'newPasswd',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'newPasswd'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'reTypeNewPasswd'); ?>
            <?php echo $form->passwordField($model,'reTypeNewPasswd',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'reTypeNewPasswd'); ?>
        </div>
    <?php endif; ?>
    

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->