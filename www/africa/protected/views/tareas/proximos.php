<table id='tablaTareas' class="table table-condensed">
<tr><th>Fecha</th><th>Descripción</th></tr>
<?php 
$res=TareasReservas::model()->proximos();
if(count($res)>0)
foreach($res as $r){?>
<tr id='tarea_<?=$r->tarea->id?>'><td><small><?=Yii::app()->dateFormatter->format("dd/MM/yyyy",$r->tarea->fecha)?></small></td><td><?=$r->tarea->descripcion?><br><small>(<?=$r->reserva->nombreCumpleano?>)</small></td><td><a href='#' onclick='finaliza(<?=$r->tarea->id?>)'><img title='finalizar' src='images/iconos/famfam/1.png'/></a></td></tr>
<?php }?>
</table>
<script>
function finaliza(id)
{
	$.getJSON('index.php?r=tareas/finaliza',{idTarea:id}, function(data) {
    $('#tarea_'+id).remove();
});
}
</script>