<?php
$this->breadcrumbs=array(
	'Transacciones Proveedores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar TransaccionesProveedores', 'url'=>array('index')),
	array('label'=>'Nuevo TransaccionesProveedores', 'url'=>array('create')),
);


<h1>Administracion Transacciones Proveedores</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-proveedores-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idProveedor',
		'idTransaccion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
