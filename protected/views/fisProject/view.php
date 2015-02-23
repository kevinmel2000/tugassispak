<?php
/* @var $this FisProjectController */
/* @var $model Fis */

$this->breadcrumbs=array(
	'Fises'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Fis', 'url'=>array('index')),
	array('label'=>'Create Fis', 'url'=>array('create')),
	array('label'=>'Update Fis', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Fis', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Fis', 'url'=>array('admin')),
);
?>

<h1>View Fis #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'project_name',
		'id_fis',
		'and_method',
		'or_method',
		'implication',
		'aggregation',
		'defuzzification',
		'status',
	),
)); ?>
