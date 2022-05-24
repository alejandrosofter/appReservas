
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get','htmlOptions'=>array('class'=>'form-inline')
)); ?>

		<?php echo $form->label($model,'buscar'); ?>
		<?php echo $form->textField($model,'buscar',array('class'=>'span5','placeholder'=>'Busque','size'=>80,'maxlength'=>255)); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'model'=>$model,
    'attribute'=>'fechaInicio',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'class'=>'span2',
        'placeholder'=>'Fecha Desde',
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
			'model'=>$model,
    'attribute'=>'fechaFin',
    'options'=>array(
        'showAnim'=>'fold',
         'dateFormat'=>'yy-mm-dd'
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;',
        'class'=>'span2',
        'placeholder'=>'Fecha Hasta',
        'dateFormat'=>'Y-m-d'
    ),
)); ?>
		<?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn-primary')); ?>

<?php $this->endWidget(); ?>
