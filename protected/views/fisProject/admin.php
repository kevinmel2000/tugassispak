<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Fis Project</a>  
</div>

<?php
/* @var $this FisProjectController */
/* @var $model Fis */
?>

<div id="wrapped_content">
    <h1>Manage Fis Project</h1>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>

    <div class="form_actions">
        <a href="<?php echo $this->createUrl('fisProject/create'); ?>"><span class="icon_add"></span>Create New</a>
    </div>
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fis-grid',
	'dataProvider'=>$model->search(),
//	'filter'=>$model,
    'ajaxUpdate'=>false,
	'columns'=>array(
//		'id',
        array(
                'class'=>'CButtonColumn',
            ),
		'project_name',
        array(
                'name' => 'status',
                'value' => '$data->status == 1 ? "<b>active</b>" : "deactive <a href=\' '. Yii::app()->createUrl('fisProject/setActive') .'/$data->id\'>(Set Active)</a>"',
                'type' => 'raw',
            ),
        
	),
)); ?>
    
</div>