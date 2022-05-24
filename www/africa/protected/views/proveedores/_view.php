<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreProveedor')); ?>:</b>
	<?php echo CHtml::encode($data->nombreProveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuit')); ?>:</b>
	<?php echo CHtml::encode($data->cuit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefonoFijo')); ?>:</b>
	<?php echo CHtml::encode($data->telefonoFijo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombreContacto')); ?>:</b>
	<?php echo CHtml::encode($data->nombreContacto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefonoContacto')); ?>:</b>
	<?php echo CHtml::encode($data->telefonoContacto); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('emailProveedor')); ?>:</b>
	<?php echo CHtml::encode($data->emailProveedor); ?>
	<br />

	*/ ?>

</div>