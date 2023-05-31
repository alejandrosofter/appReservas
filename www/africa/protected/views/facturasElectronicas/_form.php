<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'facturas-electronicas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span4">
	<div class="">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model'=>$model,
    'attribute'=>'fecha',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>
	<div class="">
						<?php echo $form->labelEx($model,'idCliente',array('class'=>'')); ?>
						<?php echo $form->dropDownList($model,'idCliente',CHtml::listData(Clientes::model()->findAll(), 'id', 'nombres'),array ('prompt'=>'Cliente','onchange'=>'cambiaCliente()','class'=>'chzn-select','style'=>'width:100%')); ?>
						<?php echo $form->error($model,'idCliente'); ?>
					</div>
	
					<?php echo $form->textFieldRow($model,'importe',array('class'=>'span1')); ?>
					<?php echo $form->labelEx($model,'esExcento',array('class'=>'')); ?>
		<?php echo $form->checkBox($model,'esExcento',array('class'=>'span1')); ?>

	<?php echo $form->textAreaRow($model,'detalle',array("rows"=>"4",'style'=>"width:100%")); ?>

</div>
<div class="span4">
	
	
<div class="">
			<?php echo $form->labelEx($model,'idTipoComprobante',array('class'=>'')); ?>
			<?php echo $form->dropDownList($model,'idTipoComprobante',CHtml::listData(FacturasElectronicas::model()->getTiposComprobantes(), 'Id', 'Desc'),array ('style'=>'','onchange'=>'cambiaTipoComprobante()')); ?>

			<?php echo $form->error($model,'idTipoComprobante'); ?>
	</div>

	
	<div class="">
		<?php echo $form->labelEx($model,'comprobanteAsociado',array('class'=>'')); ?>
		<?php $this->widget('ext.2select.ESelect2',array(
  'model'=>$model,
  'htmlOptions'=>array ('style'=>'width:280px','placeholder'=>'seleccione...'),
  'attribute'=>'comprobanteAsociado',
  // 'data'=>CHtml::listData(FacturasProfesionaNomencladores::model()->findAll(array('order'=>'codigoInterno')), 'id', 'codigoInterno')
)
); 
?>
		<?php echo $form->error($model,'comprobanteAsociado'); ?>
	</div>
	
	<div class="">
			<?php echo $form->labelEx($model,'tipoDoc',array('class'=>'')); ?>
			<?php echo $form->dropDownList($model,'tipoDoc',CHtml::listData(FacturasElectronicas::model()->getTipoDocumentos(), 'Id', 'Desc'),array ('style'=>'','onchange'=>'nroFactura()')); ?>

			<?php echo $form->error($model,'tipoDoc'); ?>

	</div>
	<?php echo $form->textFieldRow($model,'doc',array('class'=>'span2')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Aceptar' : 'Guardar',
		)); ?>
		

</div>

	
<?php $this->endWidget(); ?>
<script>
var cliente;
llenarFacturasCliente();
function cambiaNroComprobanteAsociado(){
	$.getJSON('index.php?r=facturasElectronicas/getComprobanteAsociado',{nroComprobante:$('#FacturasElectronicas_nroComprobanteNotaCredito').val()}, function(data) {
    cliente=data;
	$("#resNroComprobante").val(data);
})
}
function setOpciones(data)
{
	var sal=[];
	//reset options
	$('#FacturasElectronicas_comprobanteAsociado').html('').trigger('change');

	for(var i=0;i<data.length;i++){

		var idSeleccion=Number(<?=$model->comprobanteAsociado?>);
	
		var lab=""+data[i].nombreTipoComprobante+"  "+(data[i].esExcento!=='0'?"(Excento)":"")+" NRO "+data[i].nroComprobante+" $"+Number(data[i].importe).toFixed(2);
		var auxOption=new Option(lab, data[i].id, idSeleccion==Number(data[i].id));
		auxOption.setAttribute("importe",data[i].importe);
		$('#FacturasElectronicas_comprobanteAsociado').append(auxOption).trigger('change');
		}
	
    // Append it to the select
    return sal;
}
function llenarFacturasCliente()
{
	const idCliente=$("#FacturasElectronicas_idCliente").val();

	 $.getJSON("index.php?r=facturasElectronicas/getPorCliente",{idCliente},function(res){
		
      setOpciones(res);	

    })
}
function cambiaCliente()
{
	$.getJSON('index.php?r=clientes/getCliente',{idCliente:$('#FacturasElectronicas_idCliente').val()}, function(data) {
    cliente=data;
	$("#FacturasElectronicas_doc").val(data.cuit);
	$("#FacturasElectronicas_idTipoComprobante").val(data.idTipoComprobante);
	$("#FacturasElectronicas_tipoDoc").val(data.tipoDoc);
	llenarFacturasCliente();
});
}
//ALTER TABLE `facturasElectronicas` ADD `nroComprobanteNotaCredito` INT(50) NULL AFTER `nroComprobante`;

function cambiaTipoComprobante()
{
	const codigosNotasDeCredito=[3,8,13,53,203,208,213]
	const idTipoComprobante=Number($("#FacturasElectronicas_idTipoComprobante").val())
	console.log(codigosNotasDeCredito.indexOf(idTipoComprobante));
	if(codigosNotasDeCredito.indexOf(idTipoComprobante)>-1)
	{
		$("#nroComprobanteNotaCredito").show();
	}
	else
	{
		$("#nroComprobanteNotaCredito").hide();
	}
}

</script>