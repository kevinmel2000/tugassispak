<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('user/admin'); ?>">User</a>
    <small>></small> 
    <a href="#">View</a>
</div>

<?php
/* @var $this UserController */
/* @var $model User */
?>

<div id="wrapped_content">
    <h1>View User '<?php echo $model->user_name; ?>'</h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('user/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'name',
            'user_name',
            array(
                'label' => 'Level',
                'value' => isset($model->userLevel) ? $model->userLevel->name : NULL,
                'type' => 'raw',
            ),
            'email',
            'register_date',
            'register_by',
            'last_login_date',
            'last_ip_address',
        ),
    )); ?>
</div>