<?php
$this->breadcrumbs=array(
	'Transacciones Clientes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesClientes', 'url'=>array('index')),
	array('label'=>'Nuevo TransaccionesClientes', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro TransaccionesClientes <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>