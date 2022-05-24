<h3><img src="images/tarea.png"/> Tareas <small><a href="#" onclick='mostrarAgregarTarea()' id='btnAgrega'>(+)</a></small></h3>

<table id='tablaTareas' class="table table-condensed">
<tr><th>Tarea</th></tr>
</table>


<div id='agregaTarea' style='display:none'>
<textarea style="font-size:11px;width:100%" placeholder="Detalle de la tarea" id="detalleTarea" name="detalleTarea" type="text"></textarea>
 </div>
 <script>
 var tareas = new Array();
 $('#detalleTarea').keypress(function(e) {
    if(e.which == 13) {
        agregarTarea()
    }
});
 function agregarTarea()
 {
 	var tarea={id:tareas.length,fecha:'',descripcion:$('#detalleTarea').val(),estado:'PENDIENTE'};
 	agregarItemTarea(tarea);
  mostrarAgregarTarea()
 }
 function agregarItemTarea(tarea)
{
      tareas.push({idTarea:tarea.id,fecha:'',descripcion:tarea.descripcion,estado:tarea.estado});
      $('#detalleTarea').val('');
      $('#detalleTarea').focus();
      var img=(tarea.estado=="PENDIENTE")?"bullet_orange.png":"bullet_green.png";
      var imagen='<img title="'+tarea.estado+'" src="images/iconos/famfam/'+img+'"/>';
      $('#tablaTareas tr:last').after('<tr id="filaTarea_'+tarea.id+'"><td>'+imagen+tarea.descripcion+'</td><td><a href="#" onclick="quitarTareaHoy('+tarea.id+')"><img src="images/iconos/famfam/cancel.png"/></a></td></tr>');
     
}
function mostrarAgregarTarea()
{
	if($('#agregaTarea').attr('style')==''){
		$('#agregaTarea').attr('style','display:none');
		$('#btnAgrega').html('(+)');
		}else {
			$('#agregaTarea').attr('style','');
			$('#btnAgrega').html('(-)');
			$('#detalleTarea').focus();
		}
}
function quitarTareaHoy(idTarea)
{
      $('#filaTarea_'+idTarea).remove();
      quitarTarea(idTarea);
}
function quitarTarea(idTarea)
{
      for (var i = 0; i < tareas.length; i++)
            if(tareas[i].idTarea==idTarea)
                  tareas.splice( i, 1 );
}
 </script>

<?php

foreach($model->tareas as $tare){

echo "<script>var aux={id:".$tare->tarea->id.",fecha:'".$tare->tarea->fecha."',descripcion:'".$tare->tarea->descripcion."',estado:'".$tare->tarea->estado."'};
agregarItemTarea(aux);
</script>";
}
?>