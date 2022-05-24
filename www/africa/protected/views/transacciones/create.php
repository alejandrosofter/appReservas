<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	'Nuevo Ingreso',
);

$this->menu=array(
	array('label'=>'Listar Transacciones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Ingreso</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelCliente'=>$modelCliente)); ?>