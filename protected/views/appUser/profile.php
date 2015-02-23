<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('appUser/profile'); ?>"> Profile</a>  
</div>



<div id="wrapped_content">
     <h1>Profile</h1>
     
     <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('appUser/editProfile'); ?>"><span class="icon_edit"> </span>Edit</a>
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