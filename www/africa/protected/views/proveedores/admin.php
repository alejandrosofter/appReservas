<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Proveedores', 'url'=>array('index')),
	array('label'=>'Nuevo Proveedores', 'url'=>array('create')),
);


<h1>Administracion Proveedores</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'proveedores-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreProveedor',
		'cuit',
		'direccion',
		'telefonoFijo',
		'nombreContacto',
		/*
		'telefonoContacto',
		'emailProveedor',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
