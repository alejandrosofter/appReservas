<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promociones-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span5">
	<div class="">
		<?php echo $form->labelEx($model,'titulo',array('class'=>'')); ?>
		<?php echo $form->textField($model,'titulo',array('class'=>'span5','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'importe',array('class'=>'')); ?>
		<?php echo $form->textField($model,'importe',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'importe'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'porcentaje',array('class'=>'')); ?>
		<?php echo $form->textField($model,'porcentaje',array('class'=>'span1')); ?>
		<?php echo $form->error($model,'porcentaje'); ?>
	</div>
	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Aceptar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
</div>
<div class="span4">
	<div class="">
		<?php echo $form->labelEx($model,'fechaInicio',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model'=>$model,
    'attribute'=>'fechaInicio',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'

    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'dateFormat'=>'Y-m-d',
        'class'=>'span2',
    ),
)); ?>
		<?php echo $form->error($model,'fechaInicio'); ?>
	</div>

	<div class="">
		<?php echo $form->labelEx($model,'fechaExpira',array('class'=>'')); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model'=>$model,
    'attribute'=>'fechaExpira',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'class'=>'span2',
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php echo $form->error($model,'fechaExpira'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'Servicios',array('class'=>'')); ?>
		<?php echo CHtml::dropDownList('servicios[]',$model->servicios,CHtml::listData(Servicios::model()->findAll(), 'id', 'nombreServicio'),array ('multiple'=>'true','placeholder'=>'Seleccione los servicios','class'=>'chzn-select','style'=>'width:100%')); ?>
	</div>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
