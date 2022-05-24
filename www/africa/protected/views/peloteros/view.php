<?php
$this->breadcrumbs=array(
	'Peloteroses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Peloteros', 'url'=>array('index')),
	array('label'=>'Create Peloteros', 'url'=>array('create')),
	array('label'=>'Update Peloteros', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Peloteros', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Peloteros', 'url'=>array('admin')),
);
?>

<h1>View Peloteros #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'detalle',
	),
)); ?>
