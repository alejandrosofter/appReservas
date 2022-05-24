<h1>Impresión de Comprobante</h1>
Por favor aguarde a que el gestor de impresoras inicie, luego seleccione la impresora deseada:<br>
<a href='index.php?r=transacciones/createIngreso'>Cargar nuevo Ingreso</a><br>
<a href='index.php?r=reseras/create'>Cargar Reserva</a><br>
<a href='index.php?r='>Calendario</a><br>
<div id='imp' style='display:none'></div>
<script>
function imprimirComprobante(id)
{
  $.getJSON('index.php?r=transacciones/getImpresion',{"id":id}, function(data) {
$( "#imp" ).html(data.data);
$('#imp').print();
//window.location.replace('index.php?r=transacciones');
  });
}
imprimirComprobante(<?=$model->id;?>);

</script>