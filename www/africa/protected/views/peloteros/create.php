<?php
$this->breadcrumbs=array(
	'Peloteroses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Peloteros', 'url'=>array('index')),
);
?>
<header id="page-header">
<h1 id="page-title">Nuevo Peloteros</h1>
</header>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>