<?php
$this->breadcrumbs=array(
	'Tareases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Tareas', 'url'=>array('index')),
	array('label'=>'Nuevo Tareas', 'url'=>array('create')),
);


<h1>Administracion Tareases</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tareas-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'descripcion',
		'estado',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
