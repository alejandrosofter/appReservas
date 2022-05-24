
	<div class="">
		<?php echo $form->labelEx($model,'idProveedor',array('class'=>'')); ?>
		<?php echo $form->dropDownList($model,'idProveedor',CHtml::listData(Proveedores::model()->findAll(), 'id', 'nombreProveedor'),array ('class'=>'chzn-select','style'=>'width:200px')); ?>
		<?php echo $form->error($model,'idProveedor'); ?>
	</div>
