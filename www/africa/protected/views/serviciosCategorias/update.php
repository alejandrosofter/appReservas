<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Categorias'=>array('/serviciosCategorias'),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar categoria', 'url'=>array('index')),
	array('label'=>'Nueva Categoria', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ServiciosCategorias <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>