<?php
$this->breadcrumbs=array(
	'Servicios Peloteroses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ServiciosPeloteros', 'url'=>array('index')),
	array('label'=>'Nuevo ServiciosPeloteros', 'url'=>array('create')),
);


<h1>Administracion Servicios Peloteroses</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-peloteros-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'idServicio',
		'idPelotero',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
