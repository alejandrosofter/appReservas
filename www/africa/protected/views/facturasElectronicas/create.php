<?php
$this->breadcrumbs=array(
	'Comprobantes Electronicos'=>array('index'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Comprobantes Electronicos','url'=>array('index')),
);
?>

<h1>Nuevo Comprobante Electronico</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>