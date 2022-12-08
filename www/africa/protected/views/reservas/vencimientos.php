
<h1>VENCIMIENTOS de reservas</h1>
<div class="">
<a class="btn btn-primary" onclick="checkValores()">CHECKEAR y ACTUALIZAR VALORES</a> 
<div id="resCheck"></div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reservas-grid',
	'dataProvider'=>$model->with('pagado','servicios','cliente')->vencimientos(),
// 	'rowOptions'=>function($model){
// 		if($model->estado == "PENDIENTE"){
// 			return ['class' => 'row-reservaPendiente'];
// 			else if($model->estado == "CANCELADA"){
// 				return ['class' => 'row-reservaCancelada'];
// 			}
// 		}
// },
	'rowCssClassExpression'=>'$data->estado=="CANCELADA"?"row-reservaCancelada":"row-reservaPendiente"',

	'columns'=>array(
		array('type'=>'html','value'=>'"<small>".Yii::app()->dateFormatter->format("dd/MM/yy",$data->fecha)."</small>"', 'header'=>'Fecha'), 

		'cliente.nombres',
		// array('header'=>'Detalle del servicio','value'=>'$data->detalleServicios','type'=>'html'),
		'nombreCumpleano',
		array('type'=>'html','value'=>'"<strong> $ ".number_format($data->importe,2)."</strong>"', 'header'=>'Importe'), 
		array('type'=>'html','value'=>'"<strong style=\"color:green\"> $ ".number_format($data->pagado,2)."</strong>"', 'header'=>'Pagado'), 
		
		array('header'=>'Desde Reserva...','value'=>'$data->diasReserva'),
		array('header'=>'Estado Tarifa','value'=>'$data->estadoActualizarTarifa()'),
		array('header'=>'Estado Actualizacion','value'=>'$data->estadoActualizacion()'),
		array('type'=>'html','header'=>'Estado', 'value'=>'"<strong style=\'color:".$data->getColor()."\'>".$data->estado."</strong>"',),
		//array('header'=>'Comienza ...','type'=>'html','value'=>'"<abbr class=\'timeago\' title=\'".$data->comienza."\'></abbr>"'),
		array(
			'htmlOptions'=>array('style'=>'width:90px'),
			'class'=>'CButtonColumn', 'template'=>'{update} {delete}',
			'buttons'=>array(
				'cambiaImporte' => array(
					'label'=>'Cambiar Importe',
					 'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
					'imageUrl'=>'images/iconos/famfam/money.png',
					'url' => '"index.php?r=reservas/cambiarImporte&id=".$data->id',

				),
				'facturar' => array(
					'label'=>'Facturar',
					//  'options'=>array('class'=>'imprime','data-fancybox-type'=>'iframe'),
					'imageUrl'=>'images/iconos/famfam/tab_go.png',
					'url' => '"index.php?r=facturasElectronicas/create&idReserva=".$data->id',

				),
				),
		),
	),
)); ?>
<script>
function checkValores(){
	$("#resCheck").html("Aguerde...");
    $.get('index.php?r=reservas/checkValores', function(data,error) {
		// console.log(data)
        $("#resCheck").html(data);
		setTimeout(() => {
			location.reload();
		}, 5000);
		//actualizar pagina
		// location.reload();


})
}
</script>