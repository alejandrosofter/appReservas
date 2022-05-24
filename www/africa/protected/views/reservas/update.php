<?php
$this->breadcrumbs=array(
	'Reservas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Reservas', 'url'=>array('index')),
	array('label'=>'Nuevo Reservas', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar Reserva</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>