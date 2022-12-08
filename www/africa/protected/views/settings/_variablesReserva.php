<h3>Configs de Reservas</h3>
<div style="margin:15px">

	<div class="">
		<b><?php echo 'CANTIDAD DIAS VTO.' ?></b>
		<?php echo CHtml::textField('RESERVAS_DIAS_VTO',Settings::model()->getValorSistema('RESERVAS_DIAS_VTO'),array('class'=>'span3','size'=>50)); ?>
       <br> <span ><i> * Son la cantidad de dias, que pasado ese tiempo, la reserva actualiza el importe en caso de que se modifique el importe del servicio.</i></span>
	</div>
	
</div>