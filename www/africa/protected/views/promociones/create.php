<?php
$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	'Nueva',
);

$this->menu=array(
	array('label'=>'Listar Promociones', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Promocion</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>