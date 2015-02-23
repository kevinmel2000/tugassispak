<?php
/* @var $this FisProjectController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fises',
);

$this->menu=array(
	array('label'=>'Create Fis', 'url'=>array('create')),
	array('label'=>'Manage Fis', 'url'=>array('admin')),
);
?>

<h1>Fises</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
