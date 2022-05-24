<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proveedores-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreProveedor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreProveedor',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreProveedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuit',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cuit',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cuit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'direccion',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefonoFijo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefonoFijo',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefonoFijo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombreContacto',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreContacto',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreContacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefonoContacto',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefonoContacto',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefonoContacto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emailProveedor',array('class'=>'')); ?>
		<?php echo $form->textField($model,'emailProveedor',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'emailProveedor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
