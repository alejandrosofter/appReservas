<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Peloteros'=>array('/serviciosPeloteros&idServicio='.$_GET['idServicio']),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar ServiciosPeloteros', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Agregar Pelotero</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>