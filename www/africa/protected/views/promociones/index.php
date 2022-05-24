<?php
$this->breadcrumbs=array(
	'Promociones',
);
$this->menu=array(
	array('label'=>'Nueva Promoción', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Promociones</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'promociones-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'titulo',
		'importe',
		'porcentaje',
		'fechaInicio',
		'fechaExpira',
		array('header'=>'Estado','value'=>'$data->estado'),
		array(
			'class'=>'CButtonColumn','template'=>'{update} {delete}'
		),
	),
)); ?>
