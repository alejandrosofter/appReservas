<?php
$this->breadcrumbs=array(
	'Cierre Cajas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Listar CierreCaja', 'url'=>array('index')),
	array('label'=>'Nuevo CierreCaja', 'url'=>array('create')),
);


<h1>Administracion Cierre Cajas</h1>

<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cierre-caja-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fecha',
		'formaDePago',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
