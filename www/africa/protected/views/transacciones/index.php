 <?php
$this->breadcrumbs=array(
	'Transacciónes',
);
$this->menu=array(
	array('label'=>'Nuevo Ingreso', 'url'=>array('createIngreso')),
	array('label'=>'Nuevo Egreso', 'url'=>array('createEgreso')),
);
?>

<header id="page-header">
<h1 id="page-title">Administración de Transacciones</h1>
</header>
<?=$this->renderPartial('_search',array('model'=>$model));?><?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transacciones-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		array('header'=>'','type'=>'html','value'=>'$data->icono'),
		array('header'=>'Fecha','type'=>'html','value'=>'Yii::app()->dateFormatter->format("dd/MM/yyyy",$data->fecha)'),
		array('header'=>'Receptor','type'=>'html','value'=>'"<big><b>".$data->nombreEmisor."</b></big>"'),
		
		array('header'=>'Nro Comprobante','type'=>'html','value'=>'$data->nroComprobante'),
		array('header'=>'Tipo','type'=>'html','value'=>'$data->tipoComprobante->nombreTipoTransaccion'),
		'detalle',
		array('header'=>'Importe Percibido','type'=>'html','value'=>'"$ ".$data->importe'),
		array('header'=>'Importe Facturado','type'=>'html','value'=>'$data->importeFacturado==""?"-":"$ ".$data->importeFacturado'),
		array(
			'class'=>'CButtonColumn','template'=>'{imprimir} {update} {delete}',
			'buttons'=>array(
				'imprimir' => array(
                
                'label'=>'Imprimir',
                'imageUrl'=>'images/iconos/famfam/printer.png',
                'url' => '"javascript:imprimir($data->id)"',

            ),
				 'peloteros' => array(
                
                'label'=>'Peloteros',
                'imageUrl'=>'images/iconos/famfam/ball.png',
                'url' => '"index.php?r=itemsAsociados/index&idAsociado=".$data->id',

            ),
				 'update' => array(
                'label'=>'Actualizar',
                'url' => 'isset($data->cliente)?"index.php?r=transacciones/update&id=".$data->id:"index.php?r=transacciones/updateProveedor&id=".$data->id',

            ),
				)
		),
	),
)); ?>
<div id='imp' style='display:none'></div>
<script>

function imprimir(id)
{
	$.getJSON('index.php?r=transacciones/getImpresion',{"id":id}, function(data) {
$( "#imp" ).html(data.data);
$('#imp').print();

	});
}
</script>