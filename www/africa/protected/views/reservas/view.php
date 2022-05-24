<?php
$this->breadcrumbs=array(
	'Reservases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Reservas', 'url'=>array('index')),
	array('label'=>'Create Reservas', 'url'=>array('create')),
	array('label'=>'Update Reservas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reservas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reservas', 'url'=>array('admin')),
);
?>

<h1>View Reservas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idCliente',
		'nombreCumpleano',
		'estado',
		'importe',
	),
)); ?>
