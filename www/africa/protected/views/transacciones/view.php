<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Transacciones', 'url'=>array('index')),
	array('label'=>'Create Transacciones', 'url'=>array('create')),
	array('label'=>'Update Transacciones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Transacciones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Transacciones', 'url'=>array('admin')),
);
?>

<h1>View Transacciones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fecha',
		'importe',
		'detalle',
		'color',
	),
)); ?>
