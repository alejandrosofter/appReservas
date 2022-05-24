<div id='formularioCreate' class="row">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reservas-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,isset($_GET['idCliente'])?'nombreCumpleano':'idCliente')
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="span3">
<h3>Datos de la Reserva</h3>
<?php echo $form->textField($model,'id',array('TYPE'=>'hidden')); ?>
<div class="">
						<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
						<?php echo $form->textField($model,'fecha',array('class'=>'span2','size'=>60,'maxlength'=>255)); ?>
						<?php echo $form->error($model,'fecha'); ?>
					</div>

                  	<div class="">
						<?php echo $form->labelEx($model,'idCliente',array('class'=>'')); ?>
						<?php echo $form->dropDownList($model,'idCliente',CHtml::listData(Clientes::model()->findAll(), 'id', 'nombres'),array ('prompt'=>'Cliente','onchange'=>'cambiaCliente()','class'=>'chzn-select','style'=>'width:100%')); ?>
						<?php echo $form->error($model,'idCliente'); ?>
					</div>

					<div class="">
						<?php echo $form->labelEx($model,'nombreCumpleano',array('class'=>'')); ?>
						<?php echo $form->textField($model,'nombreCumpleano',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
						<?php echo $form->error($model,'nombreCumpleano'); ?>
					</div>

					<div class="">
						<?php echo $form->labelEx($model,'idTipoReserva',array('class'=>'')); ?>
						<?php echo $form->dropDownList($model,'idTipoReserva',CHtml::listData(ReservasTipos::model()->findAll(), 'id', 'nombreTipoReserva'),array ('style'=>'width:100%')); ?>
						<?php echo $form->error($model,'idTipoReserva'); ?>
					</div>
					
</div>
<div class="span6"><?=$this->renderPartial('servicios',array('model'=>$model))?></div>
<div class="span3 pull-right"><?=$this->renderPartial('tareas',array('model'=>$model))?></div>
<div class="span3 pull-right"><?=$this->renderPartial('pagos',array('model'=>$model))?>
<?=!isset($nuevo)?"<span class='text-warning'>En las modificaciones de reserva <b>no se pueden modificar los pagos</b></span>":""?>
</div>

<?php $this->endWidget(); ?>

<br><br>
<div id='errores' class='span9' style='display:none'>
	<div class="alert alert-block alert-error fade in">
	            <div id='contenidoError'></div>
	 </div>
</div>
<div id='printer' style='display:none'></div>
<a id='btnAceptar' href="#" style="width:90%" onclick="<?=isset($nuevo)?'agregarReserva()':'actualizaReserva()'?>" class='btn btn-primary'>Aceptar</a>
</div>
<script>
var cliente=new Array();
function agregarReserva()
{
	 if(pagos.length==0){
	 	var pass=prompt('Ingrese el codigo de acceso');
	 	if(pass=="<?=Settings::model()->getValorSistema('AUTORIZA_RESERVA');?>") agregarReserva_();
	 	else alert('Codigo incorrecto, por favor vuelva a intentarlo');
	 }else agregarReserva_()
}
function agregarReserva_()
{
	$('#formularioCreate').block({ 

                message: '<h1>Procesando</h1> Se está ingresando la reserva y enviando un correo de notificación al cliente a <b>'+cliente.email+"</b><br>", 
                css: { border: '3px solid #ccc' } 
            }); 
	
	$.getJSON('index.php?r=reservas/create',{"Reservas[fecha]":$('#Reservas_fecha').val(),"Reservas[idCliente]":$('#Reservas_idCliente').val(),"Reservas[idTipoReserva]":$('#Reservas_idTipoReserva').val(),"Reservas[nombreCumpleano]":$('#Reservas_nombreCumpleano').val(),"Reservas[estado]":$('#Reservas_estado').val(),Servicios:servicios,Tareas:tareas,Pagos:pagos}, function(data) {
    if(data.error){
    	mostrarError(data.mensaje);
    	$('#formularioCreate').unblock(); 
    }else{
    	if(pagos.length>0)
    	 	imprimir(data.idTransaccion);
    	 	//else window.location = "index.php?r=reservas";
    	 
    	} 
});
}
function cambiaCliente()
{
	$.getJSON('index.php?r=clientes/getCliente',{idCliente:$('#Reservas_idCliente').val()}, function(data) {
    cliente=data;
});
}
function actualizaReserva()
{
	ocultarError();
	 $('#formularioCreate').block({ 
	 	
                message: '<h1>Procesando</h1> Se está guardando la reserva!', 
                css: { border: '3px solid #ccc' } 
            }); 
	$.getJSON('index.php?r=reservas/update',{"id":<?=$model->id==''?0:$model->id?>,"Reservas[idCliente]":$('#Reservas_idCliente').val(),"Reservas[fecha]":$('#Reservas_fecha').val(),"Reservas[idTipoReserva]":$('#Reservas_idTipoReserva').val(),"Reservas[nombreCumpleano]":$('#Reservas_nombreCumpleano').val(),"Reservas[estado]":$('#Reservas_estado').val(),Servicios:servicios,Tareas:tareas,Pagos:pagos}, function(data) {
    
    if(data.error){
    	mostrarError(data.mensaje);
    	$('#formularioCreate').unblock(); 
    }else window.location = "index.php?r=reservas";
});
}
function ocultarError()
{
	$('#errores').hide();
	$('#contenidoError').html('');
}
function mostrarError(err)
{
	$('#errores').show();
	$('#contenidoError').html(err);
	window.setTimeout(function() { ocultarError() }, 5000);
}
function imprimir(id)
{
	$.getJSON('index.php?r=transacciones/getImpresion',{"id":id}, function(data) {
$('#formularioCreate').block({ 

                message: '<h1>Imprimiendo</h1> Se ha ingresado la reserva y en este momento se está imprimiendo el comprobante, que desea hacer?<br>'+
                "<a href='index.php?r=reservas'>Volver a reservas</a><br>"+
                "<a href='index.php?r=reservas/create'>Nueva Reserva</a><br>"+
                "<a id='linkCal' href='index.php'>Calendario</a><br>", 
                css: { border: '3px solid #ccc' } 
            }); 
$( "#printer" ).html(data.data);
$('#printer').print();
//window.location = "index.php?r=reservas";

	});
}
</script>