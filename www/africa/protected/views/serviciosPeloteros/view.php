<?php
$this->breadcrumbs=array(
	'Servicios Peloteroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiciosPeloteros', 'url'=>array('index')),
	array('label'=>'Create ServiciosPeloteros', 'url'=>array('create')),
	array('label'=>'Update ServiciosPeloteros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiciosPeloteros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiciosPeloteros', 'url'=>array('admin')),
);
?>

<h1>View ServiciosPeloteros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'idServicio',
		'idPelotero',
	),
)); ?>
