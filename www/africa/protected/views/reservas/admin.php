<?php
$this->breadcrumbs=array(
	'Reservases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Reservas', 'url'=>array('index')),
	array('label'=>'Nuevo Reservas', 'url'=>array('create')),
);


<h1>Administracion Reservases</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reservas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idCliente',
		'nombreCumpleano',
		'estado',
		'importe',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
