<?php
$this->breadcrumbs=array(
	'Transacciones Clientes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransaccionesClientes', 'url'=>array('index')),
	array('label'=>'Create TransaccionesClientes', 'url'=>array('create')),
	array('label'=>'Update TransaccionesClientes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransaccionesClientes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransaccionesClientes', 'url'=>array('admin')),
);
?>

<h1>View TransaccionesClientes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idCliente',
		'idTransaccion',
	),
)); ?>
