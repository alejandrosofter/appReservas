<?php
$this->breadcrumbs=array(
	'Transacciones Clientes',
);
$this->menu=array(
	array('label'=>'Nuevo TransaccionesClientes', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Transacciones Clientes</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-clientes-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'idCliente',
		'idTransaccion',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
