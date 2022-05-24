<link href='js/fullcalendar/fullcalendar.css' rel='stylesheet' />
<script src='js/fullcalendar/fullcalendar.min.js'></script>
<form class="form-search" id="yw0">

<input placeholder="ANO" type='text' id='ano' style="width:40px" value="<?=Date('Y')?>"/>
<input id='botonCargar' class="btn btn-primary" style="width:60px"  onclick='consultarReservas()'  name="yt0" value="Buscar">
<img id='cargador' src='images/ajax-loader.gif'/>
</form>
<script>

function checkFeriado(date,cell,feriados)
{
	for(var i=0;i<feriados.length;i++)
		if(feriados[i].fecha==date)cell.addClass('feriado');
		
}
function pad(n, length){
   n = n.toString();
   while(n.length < length) n = "0" + n;
   return n;
}
function getFecha(date)
{
	return date.getFullYear()+'-'+pad(date.getMonth()+1,2)+'-'+pad(date.getDate(),2);
}
function checkPromocion(date,cell,promociones)
{
	for(var i=0;i<promociones.length;i++){
		var fechaInicio=new Date(promociones[i].fechaInicio);
		var fechaExpira=new Date(promociones[i].fechaExpira);
		var fecha=new Date(date);
		if(fecha>=fechaInicio && fecha<=fechaExpira)cell.addClass('promocion');
	}
		
}
	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		
	});
 consultarReservas();
function consultarReservas()
{
	$('#cargador').show();
	$('#calendar').html('');
	$('#botonCargar').val('cargando...');
	$.getJSON('index.php?r=reservas/todas&ano='+$('#ano').val(), function(data) {
    console.log(data.reservas)
    $('#calendar').fullCalendar({
dayRender: function(date, cell) {
        checkFeriado(getFecha(date),cell,data.feriados);
        checkPromocion(getFecha(date),cell,data.promociones);
    },
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ], 
   monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
   dayNames: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
   dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
   buttonText: {
    today: 'hoy',
    month: 'mes',
    week: 'semana',
    day: 'día'
   },
			selectable: false,
			selectHelper: false,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: data.reservas
		});
$('#botonCargar').val('Buscar');
$('#cargador').hide();
});

}
</script>
<style>


	#calendar {
		width: 750px;
		margin: 0 auto;
		}
		div.gastro
	{
		background:white url('images/gastro.png')  right top;
		background-repeat: no-repeat;
		color:#000;
	}
	div.ambientacion
	{
		background:white url('images/ambientacion.png')  right top;
		background-repeat: no-repeat;
		color:#000;
	}
	div.gastroAmbientacion{
		background:white url('images/gastroAmbientacion.png')  right top;
		background-repeat: no-repeat;
		color:#000;
	}
	td.feriado{
		background-color:#ff9191;
	}
	td.promocion{
		background-color:#91bdff;
	}


</style>
<div id='calendar'></div>