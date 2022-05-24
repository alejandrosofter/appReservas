<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombres')); ?>:</b>
	<?php echo CHtml::encode($data->nombres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefonoFijo')); ?>:</b>
	<?php echo CHtml::encode($data->telefonoFijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefonoMovil')); ?>:</b>
	<?php echo CHtml::encode($data->telefonoMovil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcionCliente')); ?>:</b>
	<?php echo CHtml::encode($data->descripcionCliente); ?>
	<br />


</div>