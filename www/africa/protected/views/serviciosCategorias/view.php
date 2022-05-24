<?php
$this->breadcrumbs=array(
	'Servicios Categoriases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiciosCategorias', 'url'=>array('index')),
	array('label'=>'Create ServiciosCategorias', 'url'=>array('create')),
	array('label'=>'Update ServiciosCategorias', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiciosCategorias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiciosCategorias', 'url'=>array('admin')),
);
?>

<h1>View ServiciosCategorias #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombreCategoria',
		'detalle',
	),
)); ?>
