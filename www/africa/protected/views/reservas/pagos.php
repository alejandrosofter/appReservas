<h3><img src="images/pago.png"/> Pagos <small><a href="#" onclick='mostrarAgregarPago()' id='btnAgregaPago'>(+)</a></small></h3>

<table id='tablaPagos' class="table table-condensed">
<tr><th>Importe</th><th>Nro Comprobante</th></tr>

</table>

<div id='agregaPago' style='display:none'>
<input style="font-size:11px;width:60px" placeholder="Importe" id="importePago" name="importePago" type="text"></input>
  <input type="radio" class='escucha' onclick='nroFactura()' name="idTipoComprobante" checked value="2">Recibo

  

 </div>
 <script>
 var pagos = new Array();
   $('.escucha').keypress(function(e) {
    if(e.which == 13) {
        agregarPago()
    }
});
  $('#nroComprobante').keypress(function(e) {
    if(e.which == 13) {
        agregarPago()
    }
});
  $('#importePago').keypress(function(e) {
    if(e.which == 13) {
        agregarPago()
    }
});
  proximoNro();
function proximoNro()
{
  
  $.getJSON('index.php?r=transacciones/getProximo',{idTipo:2}, function(data) {
    $("#nroComprobante").show();
    $("#nroComprobante").val(data.data);
});
}
function nroFactura()
{
  
  $.getJSON('index.php?r=transacciones/getNroFactura',{idCliente:$('#Reservas_idCliente').val()}, function(data) {
    $("#nroComprobante").show();
    $("#nroComprobante").val(data.data);
});
}
 function agregarPago()
 {
 	var pago={id:-pagos.length,fecha:'',importe:$('#importePago').val(),idTipoComprobante:$("input[name='idTipoComprobante']:checked").val() };
 	agregarItemPago(pago);
      mostrarAgregarPago()
 }
 function agregarItemPago(pago)
{
      pagos.push({id:pago.id,fecha:pago.fecha,importe:pago.importe,nroComprobante:pago.nroComprobante,idTipoComprobante:pago.idTipoComprobante});
      $('#nroComprobante').val('');
      $('#importePago').val('');
      $('#importePago').focus();
      var tipo=pago.idTipoComprobante==1?'Fact.':'Rec.';
      $('#tablaPagos tr:last').after('<tr id="filaTarea_'+pago.id+'"><td>$ '+pago.importe+'</td><td>'+tipo+'</td><td><a href="#" onclick="quitarPagoaHoy('+pago.id+')"><img src="images/iconos/famfam/cancel.png"/></a></td></tr>');
     
}
function mostrarAgregarPago()
{
	if($('#agregaPago').attr('style')==''){
		$('#agregaPago').attr('style','display:none');
		$('#btnAgregaPago').html('(+)');
		}else {
			$('#agregaPago').attr('style','');
			$('#btnAgregaPago').html('(-)');
                  $('#importePago').focus();
		}
}
function quitarPagoaHoy(idPago)
{
      $('#filaTarea_'+idPago).remove();
      quitarPago(idPago);
}
function quitarPago(idPago)
{
      for (var i = 0; i < pagos.length; i++)
            if(pagos[i].id==idPago)
                  pagos.splice( i, 1 );
}
 </script>

 <?php
foreach($model->pagos as $item){

echo "<script>var aux={id:".$item->transaccion->id.",fecha:'".$item->transaccion->fecha."',importe:'".$item->transaccion->importe."',nroComprobante:'".$item->transaccion->nroComprobante."', idTipoComprobante:'".$item->transaccion->idTipoComprobante."'};
agregarItemPago(aux);
</script>";
}
?>