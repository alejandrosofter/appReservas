<h3>Datos de la Empresa</h3>
<div style="margin:15px">
	<div class="">
		<b><?php echo 'Envia Emails' ?></b>
		<?php echo CHtml::radioButtonList('ACTIVO_EMAIL',Settings::model()->getValorSistema('ACTIVO_EMAIL'),array('1'=>'Activo','0'=>'Desactivado'),
		 array(
    'labelOptions'=>array('style'=>'display:inline'), // add this code
    'separator'=>'  ')); ?>
	</div>
	<div class="">
		<b><?php echo 'Host' ?></b>
		<?php echo CHtml::textField('EMAIL_HOST',Settings::model()->getValorSistema('EMAIL_HOST'),array('class'=>'span3','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Usuario' ?></b>
		<?php echo CHtml::textField('EMAIL_USUARIO',Settings::model()->getValorSistema('EMAIL_USUARIO'),array('class'=>'span3','size'=>50)); ?>
	</div>
	<div class="">
		<b><?php echo 'Clave' ?></b>
		<?php echo CHtml::textField('EMAIL_CLAVE',Settings::model()->getValorSistema('EMAIL_CLAVE'),array('class'=>'span2','size'=>50)); ?>
	</div>
</div>