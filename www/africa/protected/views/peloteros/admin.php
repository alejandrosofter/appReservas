<?php
$this->breadcrumbs=array(
	'Peloteroses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar Peloteros', 'url'=>array('index')),
	array('label'=>'Nuevo Peloteros', 'url'=>array('create')),
);


<h1>Administracion Peloteroses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'peloteros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
