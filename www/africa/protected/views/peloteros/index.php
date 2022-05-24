<?php
$this->breadcrumbs=array(
	'Peloteros',
);
$this->menu=array(
	array('label'=>'Nuevo Pelotero', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Peloteros</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'peloteros-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombre',
		'detalle',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
