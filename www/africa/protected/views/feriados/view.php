<?php
$this->breadcrumbs=array(
	'Feriadoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Feriados', 'url'=>array('index')),
	array('label'=>'Create Feriados', 'url'=>array('create')),
	array('label'=>'Update Feriados', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Feriados', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Feriados', 'url'=>array('admin')),
);
?>

<h1>View Feriados #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'nombreFeriado',
	),
)); ?>
