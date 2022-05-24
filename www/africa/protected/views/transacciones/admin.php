<?php
$this->breadcrumbs=array(
	'Transacciones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Transacciones', 'url'=>array('index')),
	array('label'=>'Nuevo Transacciones', 'url'=>array('create')),
);


<h1>Administracion Transacciones</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'importe',
		'detalle',
		'color',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
