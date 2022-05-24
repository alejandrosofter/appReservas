<?php
$this->breadcrumbs=array(
	'Servicios'=>array('/servicios'),'Peloteros'
);
$this->menu=array(
	array('label'=>'Agregar Pelotero', 'url'=>array('create&idServicio='.$_GET['idServicio'])),
);
?>

<header id="page-header">
<h1 id="page-title">Peloteros del Servicio</h1>
</header>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicios-peloteros-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		
		array('header'=>'Pelotero','value'=>'$data->pelotero->nombre'),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
