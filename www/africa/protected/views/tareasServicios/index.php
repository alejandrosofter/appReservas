<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Tareas'
);
$this->menu=array(
	array('label'=>'Nueva tarea', 'url'=>array('create&idServicio='.$model->idServicio)),
);
?>

<header id="page-header">
<h1 id="page-title">Tareas por Servicio</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tareas-servicios-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'tarea.descripcion',
		'posicion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
