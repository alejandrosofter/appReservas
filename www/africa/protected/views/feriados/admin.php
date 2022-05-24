<?php
$this->breadcrumbs=array(
	'Feriadoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Feriados', 'url'=>array('index')),
	array('label'=>'Nuevo Feriados', 'url'=>array('create')),
);


<h1>Administracion Feriadoses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'feriados-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'nombreFeriado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
