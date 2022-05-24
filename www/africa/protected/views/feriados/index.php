<?php
$this->breadcrumbs=array(
	'Feriadoses',
);
$this->menu=array(
	array('label'=>'Nuevo Feriados', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Feriadoses</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'feriados-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'fecha',
		'nombreFeriado',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
