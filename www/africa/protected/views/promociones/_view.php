<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulo')); ?>:</b>
	<?php echo CHtml::encode($data->titulo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importe')); ?>:</b>
	<?php echo CHtml::encode($data->importe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('porcentaje')); ?>:</b>
	<?php echo CHtml::encode($data->porcentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaInicio')); ?>:</b>
	<?php echo CHtml::encode($data->fechaInicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaExpira')); ?>:</b>
	<?php echo CHtml::encode($data->fechaExpira); ?>
	<br />


</div>