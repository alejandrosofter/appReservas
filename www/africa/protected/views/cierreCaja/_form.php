<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cierre-caja-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span3">
	<div class="row">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model'=>$model,
    'attribute'=>'fecha',
    'options'=>array(
		'onChange'=>"cambia()",
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
		'onChange'=>"cambia()",
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'formaDePago',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'formaDePago',CHtml::listData(FormasDePago::model()->findAll(), 'id', 'nombreFormaPago'),array ('onChange'=>"cambia()")); ?>
		<?php echo $form->error($model,'formaPago'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
</div>
	<div class="span8" id="transacciones">

</div>
<div class="row buttons span12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
	function setGrilla(){
		const data={"Transacciones[fecha]":$('#CierreCaja_fecha').val(),"Transacciones[idFormaPago]":$('#CierreCaja_formaDePago').val()}
	console.log(data)
	$.post('index.php?r=transacciones/getTransacciones',data, function(data) {
		//parse data

		$("#transacciones").html(data);
	});
	}
	function setImporte(){
		const data={"Transacciones[fecha]":$('#CierreCaja_fecha').val(),"Transacciones[idFormaPago]":$('#CierreCaja_formaDePago').val()}
	console.log(data)
	$.post('index.php?r=transacciones/getImporteTransacciones',data, function(data) {
		//parse data

		$("#CierreCaja_importe").val(data);
	});
	}
function cambia(){
	setGrilla()
	setImporte()

}
	</script>