<h1>Mensual <small>Estadísitcas mensuales</small></h1>
<?=$this->renderPartial('_buscaMensual');?>
<div class='span11'>
<?=$this->renderPartial('_mensualDias',array('anualGastro'=>$anualGastro,'mensualReservas'=>$mensualReservas,'mensualCobros'=>$mensualCobros,'mensualFacturas'=>$mensualFacturas,'cantidadDias'=>$cantidadDias));?>
</div>
<div class='span5'>
<?=$this->renderPartial('_porServicio',array('data'=>$datosServicio));?>
</div>
<div class='span5'>
<?=$this->renderPartial('_porDia',array('data'=>$datosDia));?>
</div>