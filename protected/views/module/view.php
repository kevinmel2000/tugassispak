<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('module/admin'); ?>">Module</a>
    <small>></small> 
    <a href="#">View</a>
</div>

<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

<div id="wrapped_content">
    <h1>View Module '<?php echo $model->name; ?>'</h1>

    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('module/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>


    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            //'id',
            'name',
            'description',
            'url',
            array(
                'label' => 'Parent',
                'type' => 'raw',
                'value' => isset($model->parent) ? $model->parent->name : "Parent",
            ),
        ),
    )); ?>
</div>