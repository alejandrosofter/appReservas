<?php
$this->breadcrumbs=array(
	'Formas De Pagos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar FormasDePago', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo FormasDePago</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>