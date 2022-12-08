<?php
$this->breadcrumbs=array(
	'Formas De Pagos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar FormasDePago', 'url'=>array('index')),
	array('label'=>'Nuevo FormasDePago', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro FormasDePago <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>