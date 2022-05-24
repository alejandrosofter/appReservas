<?php
$this->breadcrumbs=array(
	'Tareases',
);
$this->menu=array(
	array('label'=>'Nuevo Tareas', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Tareases</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tareas-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'descripcion',
		'estado',
		'fecha',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
