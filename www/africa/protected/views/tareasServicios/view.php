<?php
$this->breadcrumbs=array(
	'Tareas Servicioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TareasServicios', 'url'=>array('index')),
	array('label'=>'Create TareasServicios', 'url'=>array('create')),
	array('label'=>'Update TareasServicios', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TareasServicios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TareasServicios', 'url'=>array('admin')),
);
?>

<h1>View TareasServicios #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idTarea',
		'idServicio',
		'posicion',
	),
)); ?>
