<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Categorias'=>array('/serviciosCategorias'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar categorias', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nueva Categoria</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>