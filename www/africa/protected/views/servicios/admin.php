<?php
$this->breadcrumbs=array(
	'Servicioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Servicios', 'url'=>array('index')),
	array('label'=>'Nuevo Servicios', 'url'=>array('create')),
);


<h1>Administracion Servicioses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreServicio',
		'importe',
		'duracionTiempo',
		'color',
		'idServicioPadre',
		/*
		'descripcion',
		'importe2',
		'idCategoria',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
