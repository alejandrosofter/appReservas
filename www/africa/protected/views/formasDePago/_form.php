<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formas-de-pago-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreFormaPago',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreFormaPago',array('class'=>'','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombreFormaPago'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
