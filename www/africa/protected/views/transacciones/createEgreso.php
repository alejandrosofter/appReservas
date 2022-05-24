<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	'Nuevo Egreso',
);

$this->menu=array(
	array('label'=>'Listar Transacciones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Egreso</h1>
</header>
<?php echo $this->renderPartial('_formEgreso', array('model'=>$model,'modelProveedor'=>$modelProveedor)); ?>