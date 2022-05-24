<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transacciones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class='span4'>
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
	<?=$this->renderPartial('/transaccionesClientes/_form2',array('form'=>$form,'model'=>$modelCliente));?>
	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'importeFacturado',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importeFacturado',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'importeFacturado'); ?>
	</div>

	

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<div class='span4'>
	<div class="">
		<?php echo $form->labelEx($model,'idTipoComprobante',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idTipoComprobante',CHtml::listData(TransaccionesTipos::model()->findAll(), 'id', 'nombreTipoTransaccion'),array ('style'=>'','onchange'=>'nroFactura()')); ?>
		<?php echo $form->error($model,'idTipoComprobante'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'nroComprobante',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nroComprobante',array('class'=>'')); ?>
		<?php echo $form->error($model,'nroComprobante'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>3, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
if("<?=$model->isNewRecord?>"!="")nroFactura();
function nroFactura()
{
  
  $.getJSON('index.php?r=transacciones/getProxNro',{idTipo:$('#Transacciones_idTipoComprobante').val()}, function(data) {
    $("#Transacciones_nroComprobante").val(data.data);
});
}
</script>