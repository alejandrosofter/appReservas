<?php
$this->breadcrumbs=array(
	'Transacciones Proveedores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesProveedores', 'url'=>array('index')),
	array('label'=>'Nuevo TransaccionesProveedores', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro TransaccionesProveedores <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>