<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Proveedores', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Proveedores</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>