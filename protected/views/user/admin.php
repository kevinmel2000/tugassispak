<div id="breadcumb">
	<a href="<?php echo Yii::app()->createUrl('appUser/index'); ?>"> <span class="icon_home"> Home </span> </a> 
    <small>></small> 
    <a href="#">User</a>  
</div>

<?php
/* @var $this UserController */
/* @var $model User */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div id="wrapped_content">
    <h1>Manage Users</h1>
    
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
        <a href="<?php echo $this->createUrl('user/create'); ?>"><span class="icon_add"></span>Create New</a>
        <a href="#" class="button search-button"> <span class="icon_search"></span> Advanced Search</a>
    </div>
    
    <div id="search_container">
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div><!-- search-form -->
    </div> 
    
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'user-grid',
        'dataProvider'=>$model->search(),
        //'filter'=>$model,
        'ajaxUpdate'=>false,
        'columns'=>array(
            array(
                'class'=>'CButtonColumn',
            ),
            array(
                'name' => 'user_name',
                'value' => 'CHtml::link(CHtml::encode($data->user_name), array("user/view", "id" => $data->id))',
                'type' => 'raw'	,
            ),
            array(
                'name' => 'user_level_id',
                'value' => 'isset($data->userLevel) ? $data->userLevel->name : ""',
                'type' => 'raw'	,
            ),
            'name',
            'email',
            'register_date',
            'last_login_date',
            'last_ip_address',
        ),
    )); ?>
    
</div>