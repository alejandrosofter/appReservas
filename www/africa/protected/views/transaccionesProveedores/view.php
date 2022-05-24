<?php
$this->breadcrumbs=array(
	'Transacciones Proveedores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TransaccionesProveedores', 'url'=>array('index')),
	array('label'=>'Create TransaccionesProveedores', 'url'=>array('create')),
	array('label'=>'Update TransaccionesProveedores', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TransaccionesProveedores', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransaccionesProveedores', 'url'=>array('admin')),
);
?>

<h1>View TransaccionesProveedores #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idProveedor',
		'idTransaccion',
	),
)); ?>
