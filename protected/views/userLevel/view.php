<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('userLevel/admin'); ?>">User Level</a>
    <small>></small> 
    <a href="#">View</a>
</div>

<?php
/* @var $this UserLevelController */
/* @var $model UserLevel */
?>


<div id="wrapped_content">
    <h1>View User Level '<?php echo $model->name; ?>'</h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('userLevel/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            //'id',
            'name',
            'description',
            array(
                'label' => 'Parent',
                'value' => isset($model->parent) ? $model->parent->name : "Parent",
                'type' => 'raw',
            ),
        ),
    )); ?>
</div>
