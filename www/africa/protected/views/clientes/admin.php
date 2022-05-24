<?php
$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Clientes', 'url'=>array('index')),
	array('label'=>'Nuevo Clientes', 'url'=>array('create')),
);


<h1>Administracion Clientes</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'clientes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombres',
		'telefonoFijo',
		'telefonoMovil',
		'email',
		'descripcionCliente',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
