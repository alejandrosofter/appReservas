<h3>Variables de Comprobantes</h3>
<div style="margin:15px">
	<div class="">
		<b><?php echo 'Prox. Nro Factura' ?></b>
		<?php echo CHtml::textField('PROXIMO_NROFACTURA',Settings::model()->getValorSistema('PROXIMO_NROFACTURA'),array('class'=>'span1','size'=>90)); ?>
	</div>
	<div class="">
		<b><?php echo 'Cantidad DIGITOS autompletar Nro Factura' ?></b>
		<?php echo CHtml::textField('PROXIMO_NROFACTURA_DIGOTOS',Settings::model()->getValorSistema('PROXIMO_NROFACTURA_DIGOTOS'),array('class'=>'span1','size'=>90)); ?>
	</div>
	<div class="">
		<b><?php echo 'Nro de Serie' ?></b>
		<?php echo CHtml::textField('PROXIMO_NROSERIE',Settings::model()->getValorSistema('PROXIMO_NROSERIE'),array('class'=>'span1','size'=>90)); ?>
	</div>
	<div class="">
		<b><?php echo 'Cantidad DIGITOS autompletar SERIE' ?></b>
		<?php echo CHtml::textField('PROXIMO_NROSERIE_DIGITOS',Settings::model()->getValorSistema('PROXIMO_NROSERIE_DIGITOS'),array('class'=>'span1','size'=>90)); ?>
	</div>

</div>