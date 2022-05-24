<?php
$this->breadcrumbs=array(
	'Transacciones Clientes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesClientes', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo TransaccionesClientes</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>