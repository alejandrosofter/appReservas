<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transacciones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="">
		<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model'=>$model,
    'attribute'=>'fecha',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>
	<?=$this->renderPartial('/transaccionesProveedores/_form2',array('form'=>$form,'model'=>$modelProveedor));?>
	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'detalle',array('class'=>'')); ?>
		<?php echo $form->textArea($model,'detalle',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'detalle'); ?>
	</div>
 
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
