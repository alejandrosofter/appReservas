<table id='tablaServicios' class="table table-condensed">
<tr><th>Cumpleañero</th><th>Detalle</th></tr>
<?php 
$res=ReservasServicios::model()->with("gastro")->proximosGastro();
if(count($res)>0)
foreach($res as $r){?>
<tr><td><a title='Cel: <?=$r->reserva->cliente->telefonoMovil?> Tel: <?=$r->reserva->cliente->telefonoFijo?>'><?=$r->reserva->nombreCumpleano==''?$r->reserva->cliente->nombres:$r->reserva->nombreCumpleano;?></a></td>
  <td><?=$r->gastro->nombreServicio?></td></tr>
<?php }?>
</table>