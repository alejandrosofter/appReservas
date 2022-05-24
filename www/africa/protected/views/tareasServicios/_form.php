<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tareas-servicios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?=$this->renderPartial('/tareas/_form2',array('model'=>$modelTarea,'form'=>$form));?>
		<?php echo $form->textField($model,'idServicio',array('TYPE'=>'hidden')); ?>

	<div >
		<?php echo $form->labelEx($model,'posicion',array('class'=>'')); ?>
		<?php echo $form->textField($model,'posicion',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'posicion'); ?>
	</div>

	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
