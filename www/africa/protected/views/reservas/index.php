<?php
$this->breadcrumbs=array(
	'Reservas',
);
$this->menu=array(
	array('label'=>'Nuevo Reservas', 'url'=>array('create')),
);
?>
<header id="page-header">
<h1 id="page-title">Administración de Reservas</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reservas-grid',
	'dataProvider'=>$model->with('pagado','servicios','cliente')->search(),
	
	'columns'=>array(
		array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"', 'header'=>'Fecha'), 

		'cliente.nombres',
		array('header'=>'Detalle del servicio','value'=>'$data->detalleServicios','type'=>'html'),
		'nombreCumpleano',
		array('type'=>'html','value'=>'"<strong> $ ".number_format($data->importe,2)."</strong>"', 'header'=>'Importe'), 
		array('type'=>'html','value'=>'"<strong style=\"color:green\"> $ ".number_format($data->pagado,2)."</strong>"', 'header'=>'Pagado'), 
		array('header'=>'Duración','value'=>'($data->duracion/60/60)." h."'),
		array('header'=>'Desde Reserva...','value'=>'$data->diasReserva'),

		//array('header'=>'Comienza ...','type'=>'html','value'=>'"<abbr class=\'timeago\' title=\'".$data->comienza."\'></abbr>"'),
		array(
			'class'=>'CButtonColumn','template'=>'{cambiaImporte} {update} {delete}',
			'buttons'=>array(
						'cambiaImporte' => array(
		                'label'=>'Cambiar Importe',
		                 'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
		                'imageUrl'=>'images/iconos/famfam/money.png',
		                'url' => '"index.php?r=reservas/cambiarImporte&id=".$data->id',

		            ),
				),
		),
	),
)); ?>
