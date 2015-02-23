<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('appUser/changePasswd'); ?>">Change Password </a>  
</div>

<?php
/* @var $this AppUserController */
/* @var $model FormChangePasswd */
/* @var $form CActiveForm */
?>


<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <div id="wrapped_content">

        <h1>Change Password</h1>
        
         <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) 
            {
                echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
            }
        ?>
        
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div id="row">
            <?php echo $form->labelEx($model, 'oldPasswd'); ?>
            <?php echo $form->passwordField($model,'oldPasswd',array('size'=>25,'maxlength'=>30)); ?>
            <?php echo $form->error($model,'oldPasswd'); ?>
        </div>

        </br>

        <div id="row">
            <?php echo $form->labelEx($model, 'newPasswd'); ?>
            <?php echo $form->passwordField($model,'newPasswd',array('size'=>25,'maxlength'=>30)); ?>
            <?php echo $form->error($model,'newPasswd'); ?>
        </div>

        <div id="row">
            <?php echo $form->labelEx($model, 'reTypeNewPasswd'); ?>
            <?php echo $form->passwordField($model,'reTypeNewPasswd',array('size'=>25,'maxlength'=>30)); ?>
            <?php echo $form->error($model,'reTypeNewPasswd'); ?>
        </div>
        
        <div id="row">
            <?php echo CHtml::submitButton('Change Password'); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

