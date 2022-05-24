<?php
$this->breadcrumbs=array(
	'Tareases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Tareas', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Tareas</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>