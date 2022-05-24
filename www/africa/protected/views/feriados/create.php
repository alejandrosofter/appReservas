<?php
$this->breadcrumbs=array(
	'Feriadoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Feriados', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Feriados</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>