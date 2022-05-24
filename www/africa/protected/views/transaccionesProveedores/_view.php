<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idProveedor')); ?>:</b>
	<?php echo CHtml::encode($data->idProveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idTransaccion')); ?>:</b>
	<?php echo CHtml::encode($data->idTransaccion); ?>
	<br />


</div>