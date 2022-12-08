<?php
$this->breadcrumbs=array(
	'Cierre Cajas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Cierres de Caja', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Cierre de Caja</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>