<h1>Generales <small>Estadísitcas variadas y generales</small></h1>
<?=$this->renderPartial('_buscadorGeneral');?>
<div class='span11'>
<?=$this->renderPartial('_anualGral',array('anualGastro'=>$anualGastro,'anualCobros'=>$anualCobros,'anualFacturas'=>$anualFacturas,'anualReservas'=>$anualReservas));?>
</div>
<div class='span5'>
<?=$this->renderPartial('_porServicio',array('data'=>$datosServicio));?>
</div>
<div class='span5'>
<?=$this->renderPartial('_porDia',array('data'=>$datosDia));?>
</div>