<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Clientes</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>