<h3><img src="images/servicio.png"/> Servicios <small><a href="#" onclick='mostrarAgregarServicio()' id='btnAgregaServicio'>(+)</a></small></h3>
<big>
<table id='tablaServicios' class="table table-condensed">
<tr><th>Detalle del Servicio</th><th>Importe</th></tr>

</table>
</big>
<div class="form-search">
<div id='agregaServicio' style='display:none'>
<b>Agregar </b> <?php echo CHtml::dropDownList('idServicio','',CHtml::listData(Servicios::model()->serviciosPadres(), 'id', 'nombreServicio'),array ('onchange'=>'cambiaServicio()','prompt'=>'SELECCIONE ...','class'=>'chzn-select','style'=>'width:150px')); ?>
 <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'name'=>'fecha',
    'id'=>'fecha',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'width:70px;height:15px; font-size:11px',
        'dateFormat'=>'Y-m-d',
        'placeholder'=>'Inicia el ...',
        'class'=>'span1',
        'onchange'=>'cambiaFecha()'
    ),
)); ?>

 <?php
$this->widget('CMaskedTextField', array(
'name' => 'hora',
'id'=>'hora',
'mask' => '99:99',
'htmlOptions' => array('style' => 'font-size:11px;height:15px','class'=>'span1','placeholder'=>'Hora   ')
));
?>
 <input style="font-size:11px;height:15px" placeholder="duracion ..." class="span1" id="duracion" name="duracion" type="text">
  $ <input style="font-size:11px;height:15px" placeholder="$ Importe" class="span1" id="importe" name="importe" type="text">
  <a style="width:16px;" onclick='agregar()' class="btn btn-warning" type="text"><i class="icon-plus-sign icon-white"></i></a>
  
  
  </div>
</div>
<div id='opciones'></div>
<div id='posibles'></div>
<script>
var auxServ;
var servicios = new Array();
var opciones = new Array();
var posibles = new Array();


$('#importe').keypress(function(e) {
    if(e.which == 13) {
        agregar()
    }
});
$('#hora').keypress(function(e) {
    if(e.which == 13) {
        agregar()
    }
});
cambiaServicio();
function mostrarAgregarServicio()
{
  if($('#agregaServicio').attr('style')==''){
    $('#agregaServicio').attr('style','display:none');
    $('#btnAgregaServicio').html('(+)');
    }else {
      $('#agregaServicio').attr('style','');
      $('#btnAgregaServicio').html('(-)');
    }
}

function cambiaServicio()
{
      $('#opciones').html('');
  $.getJSON('index.php?r=servicios/getServicio&id='+$('#idServicio').val(), function(data) {
    auxServ=data;
    $('#duracion').val(data.duracionTiempo);
    $('#importe').val(data.importe);
    
    if(servicios.length>0){
      $("#fecha").hide('fade');
      calculaHoraDuracion();

      }else{
             $("#fecha").show('fade');
              $("#duracion").show('fade');
               $("#hora").show('fade');
             
             $("#fecha").focus()
      }
   
});
}
function agregarTareas(id)
{
      $.getJSON('index.php?r=servicios/tareas&id='+$('#idServicio').val(), function(data) {
      for (var i = 0; i < data.length; i++)
            agregarItemTarea(data[i]);
   
});
}
function calculaHoraDuracion()
{
       $("#fecha").val(servicios[0].fecha);

      if(auxServ.idCategoria==2  || auxServ.idCategoria==3  ){ 
      $("#hora").hide('fade');
       $("#duracion").hide('fade');
       $("#fecha").val(servicios[0].fecha);
        $("#duracion").val(servicios[0].duracion);
        $("#hora").val(proximaHora($("#fecha").val(),$("#hora").val()));
         $("#importe").focus()
}
    else{
      $("#hora").show('fade');
      $("#duracion").show('fade');
      $("#duracion").val(servicios[0].duracion);
      $("#hora").val(proximaHora($("#fecha").val(),$("#hora").val()));
      $("#duracion").focus()
      
    }
}
function datosValidos()
{
      if($('#idServicio').val()=='') return false;
      if($('#fecha').val()=='') return false;
      if($('#hora').val()=='') return false;
      if(auxServ.idCategoria=='1')
            if($('#duracion').val()=='') return false;
      if($('#importe').val()=='') return false;
      return true;
}
function reset()
{
      $('#idServicio').val('');
      $('#idServicio').trigger("liszt:updated");
      $('#fecha').val('');
      $('#hora').val('');
      $('#duracion').val('');
      $('#importe').val('');
}
function cargarOpciones(idServicio)
{
      if(idServicio!='')
  $.getJSON('index.php?r=servicios/opciones&idServicio='+idServicio, function(data) {
      opciones=data;
      $('#opciones').html('<b>Agregar Horario ('+opciones.length+'): </b>');
    for (var i = 0; i < opciones.length; i++)cargarOpcion(opciones[i]);
    
       
});
}
function cargarOpcion(data)
{
      var link='<a href="#" onclick="clickOpcion('+data.id+')">'+data.nombreServicio+'</a> | ';
      $('#opciones').html($('#opciones').html()+' '+link);
}
function clickOpcion(id)
{
      servicio=getServicioOpcion(id);
      auxServ=servicio;
      servicioPrimario=servicios[0];
      aux=new Array();
      aux.idServicio=servicio.id;
      aux.fecha=servicioPrimario.fecha;
      aux.hora=proximaHora(aux.fecha,'');
      aux.duracion=servicio.duracionTiempo;
      aux.importe=servicio.importe;

      servicios.push({idServicio:aux.idServicio,fecha:aux.fecha,hora:aux.hora,duracionTiempo:aux.duracion,importe:aux.importe});
      agregarItem(servicio, aux);
      
}
function agregarItem(servicio, info)
{
      if(servicio.idCategoria==1)
            detalle="<b style='background-color:#"+servicio.color+"'>"+servicio.nombreServicio+"</b> comienza el día "+info.fecha+" de "+info.hora+" a <strong>"+getTiempo(info)+"</strong> hrs";
      if(servicio.idCategoria==2) detalle="<img src='images/gastro.png'/> "+servicio.nombreServicio;
      if(servicio.idCategoria==3) detalle="<img src='images/ambientacion.png'/> "+servicio.nombreServicio;
      $('#tablaServicios tr:last').after('<tr id="filaServicio_'+info.idServicio+'"><td>'+detalle+'</td><td>'+info.importe+'</td><td><a href="#" onclick="quitar('+info.idServicio+')"><img src="images/iconos/famfam/cancel.png"/></a></td></tr>');
     
     cargarOpciones($('#idServicio').val());
}
function getServicioOpcion(id)
{
      for (var i = 0; i < opciones.length; i++)
            if(opciones[i].id==id) return opciones[i];
}
function cambiaFecha()
{
  $.getJSON('index.php?r=reservas/checkImporte&idServicio='+$('#idServicio').val()+'&fecha='+$('#fecha').val(), function(data) {
    if(data.promocion.length>0)alert('En esta fecha hay una promocion de precio!');
    $('#importe').val(data.importe);
    
    
});
  $("#hora").focus()
}
function proximaHora(fecha,hora)
{
      if(servicios.length>0){
            var fecha = servicios[0].fecha.split('-');
            var hora = servicios[0].hora.split(':');

            var fecha1=Date.UTC(fecha[0],fecha[1],fecha[2],hora[0],hora[1],0);

      }else{
            var fecha = fecha.split('-');
            var hora = hora.split(':');
            var fecha1=Date.UTC(fecha[0],fecha[1],fecha[2],hora[0],hora[1],0);
      }

      var fecha2=fecha1;
      var d2=new Date(fecha2);
        
      
       for (var i = 0; i < servicios.length; i++){
            fecha2+=(servicios[i].duracionTiempo*6000*10);
      }
        var d=new Date(fecha2);

      return d.getUTCHours()+':'+d.getUTCMinutes();

}
function quitar(idServicio)
{
      $('#filaServicio_'+idServicio).remove();
      quitarServicio(idServicio);
      if(servicios.length==0)$('#opciones').html('');
}
function quitarServicio(idServicio)
{
      for (var i = 0; i < servicios.length; i++)
            if(servicios[i].idServicio==idServicio)
                  servicios.splice( i, 1 );
}
function getTiempo(info)
{
      var fecha = info.fecha.split('-');
      var hora = info.hora.split(':');

      var fecha1=Date.UTC(fecha[0],fecha[1],fecha[2],hora[0],hora[1],0);
      var fecha2=fecha1+(info.duracion*6000*10);
      var d=new Date(fecha2);
      return d.getUTCHours()+':'+d.getUTCMinutes();
}
function agregarPosibles(datos)
{
  $('#posibles').html('<b>Posibles: </b>');
  for (var i = 0; i < datos.length; i++)
    agregaPosible(datos[i],i);
}
function clickPosible(id)
{
  $('#hora').val(posibles[id].hora);
  $('#fecha').val(posibles[id].fecha);
  $('#importe').val(posibles[id].importe);
}
function agregaPosible(data,i)
{
  var fecha=$('#fecha').val()==data.fecha?'':data.fecha;
  var elem='<a id="posible_'+i+'" style="cursor:pointer" onclick="clickPosible('+i+')" >'+fecha+' de '+data.hora+' a '+data.horaFin+'</a> | ';
  $('#posibles').html($('#posibles').html()+elem);
}
function agregar()
{
  $('#posibles').html('');
      if(!datosValidos()) alert('Hay compos para completar!');
      else 
  $.getJSON('index.php?r=reservas/checkReserva&idServicio='+$('#idServicio').val()+'&fecha='+$('#fecha').val()+'&hora='+$('#hora').val()+'&duracionTiempo='+$('#duracion').val()+'&importe='+$('#importe').val(), function(data) {
   if(!data.ocupado){
              servicios.push({idServicio:$('#idServicio').val(),fecha:$('#fecha').val(),hora:$('#hora').val(),duracionTiempo:$('#duracion').val(),importe:$('#importe').val()});
              agregarItem(auxServ, {idServicio:$('#idServicio').val(),fecha:$('#fecha').val(),hora:$('#hora').val(),duracion:$('#duracion').val(),importe:$('#importe').val()});
              agregarTareas($('#idServicio').val());
              reset();
              mostrarAgregarServicio();
      }else{
          mostrarError('En la fecha y horario seleccionado el servicio requrido esta ocupado!');
          posibles=data.data;
          agregarPosibles(data.data);
      }
});
}
</script>

<?php
foreach($model->servicios as $serv){
      $duracion=($serv->fechaFin-$serv->fechaInicio)/60;
      $fecha=date("Y-m-d",$serv->fechaInicio);
      $hora=date("H:i",$serv->fechaInicio);
echo "<script>
auxServ=".CJSON::encode($serv->servicio)."
var aux={idServicio:".$serv->idServicio.",fecha:'$fecha',hora:'$hora',duracionTiempo:'$duracion',importe:".$serv->costo."};
servicios.push(aux);
agregarItem(auxServ, {idServicio:aux.idServicio,fecha:aux.fecha,hora:aux.hora,duracion:aux.duracionTiempo,importe:aux.importe});
cargarOpciones(".$serv->idServicio.");
</script>";
}
?>