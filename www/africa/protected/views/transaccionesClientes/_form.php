<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transacciones-clientes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idCliente',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idCliente',CHtml::listData(Clientes::model()->findAll(), 'id', 'nombreCliente'),array ('style'=>'width:200px')); ?>
		<?php echo $form->error($model,'idCliente'); ?>
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
