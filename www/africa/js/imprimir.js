<h1>Imprimiendo el Comprobante</h1>
Por favor aguarde a que inicie el gestor de impresoras de su pc...
<div id='imp'></div>
<script>
function imprimirComprobante(id)
{
  $.getJSON('index.php?r=transacciones/getImpresion',{"id":id}, function(data) {
$( "#imp" ).html(data.data);
$('#imp').print();
location.href('index.php?r=transacciones');
  });
}
</script>