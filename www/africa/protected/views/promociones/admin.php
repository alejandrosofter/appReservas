<?php
$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Promociones', 'url'=>array('index')),
	array('label'=>'Nuevo Promociones', 'url'=>array('create')),
);


<h1>Administracion Promociones</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'promociones-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'titulo',
		'importe',
		'porcentaje',
		'fechaInicio',
		'fechaExpira',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
