<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicios-peloteros-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idServicio',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idServicio',CHtml::listData(Servicios::model()->findAll(),
	     'id', 'nombreServicio'),array ('class'=>'chzn-select','prompt'=>'Seleccione...'));?>
		<?php echo $form->error($model,'idServicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idPelotero',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idPelotero',CHtml::listData(Peloteros::model()->findAll(),
	     'id', 'nombre'),array ('class'=>'chzn-select','prompt'=>'Seleccione...'));?>
		<?php echo $form->error($model,'idPelotero'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
