<?php
$this->breadcrumbs=array(
	'Comprobantes Electronicos',
);
$this->menu=array(
	array('label'=>'Nuevo Comprobante', 'url'=>array('create')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Comprobantes Electronicos</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'fe-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		'fecha',
		'detalle',
		array('type'=>'html','value'=>'"<strong> $ ".number_format($data->importe,2)."</strong>"', 'header'=>'Importe'), 
		'nroCae',
		array('type'=>'html','value'=>'"<small>".str_pad($data->nroComprobante,4,"0",STR_PAD_LEFT)."</small>"', 'header'=>'Nro Comp.'), 
		array('header'=>'Estado','value'=>'"<b title=\'".$data->detalleError."\'>".$data->estado."</b>"','type'=>'html'),
		array(
			'class'=>'CButtonColumn','template'=>'{print} {loadAfip} {update} {delete}',
			'buttons'=>array(
				'loadAfip' => array(
					'label'=>'Cargar AFIP',
					//  'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
					'imageUrl'=>'images/iconos/famfam/1.png',
					"visible"=>'$data->estado!="COMPLETADO"',
					'url' => '"index.php?r=facturasElectronicas/sendComprobanteAfip&id=".$data->id',

				),
				'print' => array(
					'label'=>'Imprimir',
					//  'options'=>array('class'=>'imprimeGrande','data-fancybox-type'=>'iframe'),
					'imageUrl'=>'images/iconos/famfam/printer.png',
					"visible"=>'$data->estado=="COMPLETADO"',
					'url' => '"index.php?r=facturasElectronicas/imprimir&id=".$data->id',

				),
				),
		),
	),
)); ?>
