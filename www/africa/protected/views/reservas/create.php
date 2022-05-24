<?php
$this->breadcrumbs=array(
	'Reservas'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Reservas', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Reserva</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'nuevo'=>true)); ?>