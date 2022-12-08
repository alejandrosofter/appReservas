<?php
$this->breadcrumbs=array(
	'Formas De Pagos',
);
$this->menu=array(
	array('label'=>'Nuevo FormasDePago', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración Formas De Pagos</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'formas-de-pago-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'id',
		'nombreFormaPago',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
