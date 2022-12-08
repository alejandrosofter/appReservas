<?php
$this->breadcrumbs=array(
	'Formas De Pagos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar FormasDePago', 'url'=>array('index')),
	array('label'=>'Nuevo FormasDePago', 'url'=>array('create')),
);


<h1>Administracion Formas De Pagos</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'formas-de-pago-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombreFormaPago',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
