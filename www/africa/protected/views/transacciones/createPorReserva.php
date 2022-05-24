<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	'Nuevo Ingreso por Reserva',
);

$this->menu=array(
	array('label'=>'Listar Transacciones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Ingreso por Reserva</h1>
</header>
<?php echo $this->renderPartial('_formReserva', array('model'=>$model,'modelCliente'=>$modelCliente)); ?>