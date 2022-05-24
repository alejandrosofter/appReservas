<?php
$this->breadcrumbs=array(
	'Tareas Servicioses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar TareasServicios', 'url'=>array('index')),
	array('label'=>'Nuevo TareasServicios', 'url'=>array('create')),
);


<h1>Administracion Tareas Servicioses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tareas-servicios-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idTarea',
		'idServicio',
		'posicion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
