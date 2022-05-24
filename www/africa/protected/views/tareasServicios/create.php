<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Tareas'=>array('/tareasServicios&idServicio='.$model->idServicio),
	'Nuevo'
);

$this->menu=array(
	array('label'=>'Listar TareasServicios', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Tarea</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelTarea'=>$modelTarea,'nuevo'=>1)); ?>