<?php
$this->breadcrumbs=array(
	'Cierres Cajas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar CierreCaja', 'url'=>array('index')),
	array('label'=>'Nuevo CierreCaja', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro Cierre de Caja <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>