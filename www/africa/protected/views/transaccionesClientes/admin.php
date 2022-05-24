<?php
$this->breadcrumbs=array(
	'Transacciones Clientes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesClientes', 'url'=>array('index')),
	array('label'=>'Nuevo TransaccionesClientes', 'url'=>array('create')),
);


<h1>Administracion Transacciones Clientes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-clientes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idCliente',
		'idTransaccion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
