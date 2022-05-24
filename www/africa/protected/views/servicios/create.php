<?php
$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Servicios', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Servicio</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>