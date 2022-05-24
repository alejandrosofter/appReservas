<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicios-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span4">
	<div class="">
		<?php echo $form->labelEx($model,'nombreServicio',array('class'=>'')); ?>
		<?php echo $form->textField($model,'nombreServicio',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombreServicio'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'importe2',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe2',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe2'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'duracionTiempo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'duracionTiempo',array('class'=>'')); ?>
		<?php echo $form->error($model,'duracionTiempo'); ?>
	</div>


	<div class="">
		<?php echo $form->labelEx($model,'idCategoria',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idCategoria',CHtml::listData(ServiciosCategorias::model()->findAll(), 'id', 'nombreCategoria'),array ('style'=>'width:200px')); ?>
		<?php echo $form->error($model,'idCategoria'); ?>
	</div>

	
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<div class="span4">
<div class="">
<?php echo $form->labelEx($model,'color',array('class'=>'')); ?>
		<?php $this->widget('ext.colorpicker.EColorPicker', array(
      'attribute' => 'color',
      'model'=>$model));
		?>
		<?php echo $form->error($model,'color'); ?>
	</div>
	<div class="">
		<?php echo $form->labelEx($model,'idServicioPadre',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idServicioPadre',CHtml::listData(Servicios::model()->findAll(), 'id', 'nombreServicio'),array ('style'=>'width:200px','prompt'=>'Seleccione el servicio')); ?>
		<?php echo $form->error($model,'idServicioPadre'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'descripcion',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>

	
</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->
