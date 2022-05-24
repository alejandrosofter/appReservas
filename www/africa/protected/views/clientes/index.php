<?php
$this->breadcrumbs=array(
	'Clientes',
);
$this->menu=array(
	array('label'=>'Nuevo Client', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Clientes</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clientes-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'nombres',
		'telefonoFijo',
		'telefonoMovil',
		'email',
		'condicionIva.nombreCondicionIva',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
