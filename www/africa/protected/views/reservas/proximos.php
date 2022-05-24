<table id='tablaServicios' class="table table-condensed">
<tr><th>Cumpleañero</th><th>Debe</th><th>Comienza...</th></tr>
<?php 
$res=Reservas::model()->proximos(false);
if(count($res)>0)
foreach($res as $r){?>
<tr><td><a title='Cel: <?=$r->cliente->telefonoMovil?> Tel: <?=$r->cliente->telefonoFijo?>'><?=$r->nombreCumpleano==''?$r->cliente->nombres:$r->nombreCumpleano;?></a></td><td>$  <?= $r->importe-$r->pagado?></td><td><abbr class="timeago" title="<?=$r->comienza?>"></abbr></td></tr>
<?php }?>
</table>