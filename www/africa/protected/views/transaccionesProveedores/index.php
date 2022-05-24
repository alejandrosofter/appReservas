<?php
$this->breadcrumbs=array(
	'Transacciones Proveedores',
);
$this->menu=array(
	array('label'=>'Nuevo TransaccionesProveedores', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Transacciones Proveedores</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-proveedores-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idProveedor',
		'idTransaccion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
