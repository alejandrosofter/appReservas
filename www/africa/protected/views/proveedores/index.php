<?php
$this->breadcrumbs=array(
	'Proveedores',
);
$this->menu=array(
	array('label'=>'Nuevo Proveedor', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Proveedores</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'proveedores-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreProveedor',
		'cuit',
		'direccion',
		'telefonoFijo',
		'nombreContacto',
		/*
		'telefonoContacto',
		'emailProveedor',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
