<?php
$this->breadcrumbs=array(
	'Servicios Categoriases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar ServiciosCategorias', 'url'=>array('index')),
	array('label'=>'Nuevo ServiciosCategorias', 'url'=>array('create')),
);


<h1>Administracion Servicios Categoriases</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-categorias-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreCategoria',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
