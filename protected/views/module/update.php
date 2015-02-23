<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="<?php echo Yii::app()->createUrl('module/admin'); ?>">Module</a>
    <small>></small> 
    <a href="#">Update</a>
</div>

<?php
/* @var $this ModuleController */
/* @var $model Module */
?>

<div id="wrapped_content">
    <h1>Update Module '<?php echo $model->name; ?>'</h1>
    
    <div class="form_actions"> 
        <a href="<?php echo $this->createUrl('module/admin'); ?>"><span class="icon_edit"> </span>Close</a>
    </div>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <?php echo $this->renderPartial('_form', array(
            'model'=>$model,
            'isCreate'=>true,
            'userLevel'=>$userLevel,
            'preCheckedArray'=>$preCheckedArray,)
    ); 
    ?>
</div>