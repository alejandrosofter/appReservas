<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),
	'Categorias'
);
$this->menu=array(
	array('label'=>'Nueva Categoria', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Categorias</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-categorias-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreCategoria',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
