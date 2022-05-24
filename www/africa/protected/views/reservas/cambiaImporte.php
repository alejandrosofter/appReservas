<h1>Cambio de Importe</h1>
Se cambiará el importe de la reserva de forma automática. El valor se descontará del servicio principal de la reserva.<br>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'peloteros-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>