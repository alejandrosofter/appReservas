<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Transacciones', 'url'=>array('index')),
	array('label'=>'Nuevo Transacciones', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Transacciones <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model,'modelCliente'=>$modelCliente)); ?>