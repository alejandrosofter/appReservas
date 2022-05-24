<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transacciones-proveedores-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idProveedor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idProveedor',array('class'=>'')); ?>
		<?php echo $form->error($model,'idProveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idTransaccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'idTransaccion',array('class'=>'')); ?>
		<?php echo $form->error($model,'idTransaccion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
