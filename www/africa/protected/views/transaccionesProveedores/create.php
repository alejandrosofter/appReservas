<?php
$this->breadcrumbs=array(
	'Transacciones Proveedores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesProveedores', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo TransaccionesProveedores</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>