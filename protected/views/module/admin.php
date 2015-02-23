<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">Module</a>  
</div>

<?php
/* @var $this ModuleController */
/* @var $model Module */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('module-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="wrapped_content">
    <h1>Manage Modules</h1>
    
    <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
        }
    ?>
    
    <p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
    </p>

    <div class="form_actions">
        <a href="<?php echo $this->createUrl('module/create'); ?>"><span class="icon_add"></span>Create New</a>
        <a href="#" class="button search-button"> <span class="icon_search"></span> Advanced Search</a>
    </div>

    <div id="search_container">
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div><!-- search-form -->
    </div> 

    <?php $this->widget('ext.groupgridview.GroupGridView', array(
        'id'=>'module-grid',
        'dataProvider'=>$model->search(),
        'extraRowColumns' => array('p_id'),
        //'filter'=>$model,
        'ajaxUpdate'=>false,
        'columns'=>array(
            array(
                'class'=>'CButtonColumn'
            ),
            array(
                'name' => 'name',
                'value' => 'CHtml::link(CHtml::encode($data->name), array("module/view", "id" => $data->id))',
                'type' => 'raw',
            ),
            'description',
            'url',
            array(
                'name' => 'p_id',
                'value' => '(isset($data->parent)) ? $data->parent->name : "Parent"',
                'type' => 'raw'
            ),
        ),
    )); ?>

</div>