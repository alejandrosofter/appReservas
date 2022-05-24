<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clientes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span5">
	<div class="">
		<?php echo $form->labelEx($model,'nombres',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombres',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombres'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'telefonoFijo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefonoFijo',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefonoFijo'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'telefonoMovil',array('class'=>'')); ?>
		<?php echo $form->textField($model,'telefonoMovil',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telefonoMovil'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'email',array('class'=>'')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<? if($model->isNewRecord ){?>
	<div class="">
		<?php echo $form->labelEx($model,'Hacer la reserva',array('class'=>'')); ?>
		<?php echo CHtml::checkBox('nuevaReserva',1); ?>
	</div>
	<?}?>
	<div class=" buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<div class="span5">
	<div class="">
		<?php echo $form->labelEx($model,'idCondicionIva',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idCondicionIva',CHtml::listData(CondicionesIva::model()->findAll(), 'id', 'nombreCondicionIva'),array ('style'=>'')); ?>
		<?php echo $form->error($model,'idCondicionIva'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'cuit',array('class'=>'')); ?>
		<?php echo $form->textField($model,'cuit',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cuit'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'direccion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'direccion',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'localidad',array('class'=>'')); ?>
		<?php echo $form->textField($model,'localidad',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'localidad'); ?>
	</div>
</div>

	

<?php $this->endWidget(); ?>

</div><!-- form -->
