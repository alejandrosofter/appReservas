<?php
$this->breadcrumbs=array(
	'Comprobantes Electronicos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Editar',
);
?>

<h1>Actualiza <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>