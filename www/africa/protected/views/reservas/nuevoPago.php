<?php
$this->breadcrumbs=array(
	'Reservas'=>array('index'),
	'Nuevo Pago',
);

?>
<header id="page-header">
<h1 id="page-title">Nuevo Pago</h1>
</header>
<?php echo $this->renderPartial('_formPago', array('model'=>$model,'nuevo'=>true)); ?>