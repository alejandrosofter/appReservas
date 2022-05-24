<?php
$this->breadcrumbs=array(
	'Servicios Peloteroses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar ServiciosPeloteros', 'url'=>array('index')),
	array('label'=>'Nuevo ServiciosPeloteros', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Actualizar registro ServiciosPeloteros <?php echo $model->id; ?></h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>