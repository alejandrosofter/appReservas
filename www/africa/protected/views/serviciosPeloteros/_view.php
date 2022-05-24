<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idServicio')); ?>:</b>
	<?php echo CHtml::encode($data->idServicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPelotero')); ?>:</b>
	<?php echo CHtml::encode($data->idPelotero); ?>
	<br />


</div>