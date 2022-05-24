<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Tareas'=>array('/tareasServicios&idServicio='),
	'Actualizar'
);

$this->menu=array(
	array('label'=>'Listar TareasServicios', 'url'=>array('index')),
	array('label'=>'Nuevo TareasServicios', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro TareasServicios <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelTarea'=>$modelTarea)); ?>