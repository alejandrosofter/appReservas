
	<div class="">
		<?php echo $form->labelEx($model,'idCliente',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idCliente',CHtml::listData(Clientes::model()->findAll(), 'id', 'nombres'),array ('onchange'=>'consultarReservas()','class'=>'chzn-select','style'=>'width:200px')); ?>
		<a style='display:none' target='_blank' id='irCliente' href=''>Ver cliente</a>
		<div id='reservas'></div>
		
		<?php echo $form->error($model,'idCliente'); ?>
		<input name='idReservaPago' id='idReservaPago' value='' TYPE='hidden'></input>
	</div>
<script>
function consultarReservas()
{
	$('#irCliente').show();
	getCliente();
	$('#irCliente').attr('href','index.php?r=clientes/update&id='+$('#TransaccionesClientes_idCliente').val());
	$('#reservas').html('');
	$.getJSON('index.php?r=reservas/getImpagas',{idCliente:$('#TransaccionesClientes_idCliente').val()}, function(data) {
    for (var i = 0; i < data.length; i++)
    	cargarReserva(data[i]);
});
}
function getCliente()
{
$.getJSON('index.php?r=clientes/getCliente',{idCliente:$('#TransaccionesClientes_idCliente').val()}, function(data) {
	var cuit=data.cuit==null?'s/n':data.cuit;
    $('#irCliente').html('Ver cliente ('+cuit+')');
});
}
function cargarReserva(datos)
{
	var text="<a style='cursor:pointer' onclick='clickReserva("+datos.id+","+datos.debe+")'><small><small>"+datos.comienza+"</small></small> $ "+datos.debe+" </a> | ";
	$('#reservas').html($('#reservas').html()+text);
}
function clickReserva(id,debe)
{
	$('#idReservaPago').val(id);
	$('#Transacciones_importe').val(debe);
}
</script>