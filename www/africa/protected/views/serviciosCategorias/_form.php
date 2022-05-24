<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicios-categorias-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreCategoria',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreCategoria',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreCategoria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
