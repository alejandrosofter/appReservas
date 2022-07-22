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

	<?php echo $form->textAreaRow($model,'detalle',array("rows"=>"4",'style'=>"width:100%")); ?>

</div>
<div class="span4">
	
	
<div class="">
			<?php echo $form->labelEx($model,'idTipoComprobante',array('class'=>'')); ?>
			<?php echo $form->dropDownList($model,'idTipoComprobante',CHtml::listData(FacturasElectronicas::model()->getTiposComprobantes(), 'Id', 'Desc'),array ('style'=>'','onchange'=>'cambiaTipoComprobante()')); ?>

			<?php echo $form->error($model,'idTipoComprobante'); ?>
	</div>

	
	<div id="nroComprobanteNotaCredito" >
		<?php echo $form->textFieldRow($model,'nroComprobanteNotaCredito',array('class'=>'span1')); ?>
		<i>Solo para notas de credito (nro del comprobante a anular - solo el nro)</i>
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
function cambiaCliente()
{
	$.getJSON('index.php?r=clientes/getCliente',{idCliente:$('#FacturasElectronicas_idCliente').val()}, function(data) {
    cliente=data;
	$("#FacturasElectronicas_doc").val(data.cuit);
	$("#FacturasElectronicas_idTipoComprobante").val(data.idTipoComprobante);
	$("#FacturasElectronicas_tipoDoc").val(data.tipoDoc);
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