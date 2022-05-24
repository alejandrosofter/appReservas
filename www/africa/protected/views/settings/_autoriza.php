<h3>Autorizaciones</h3>
<div class="content-form">

		<p><?php echo 'Clave Autoriza Reservas' ?>
		<?php echo CHtml::textField('AUTORIZA_RESERVA',Settings::model()->getValorSistema('AUTORIZA_RESERVA'),array('class'=>'text','maxlength'=>64));
		
		 ?>
		</p>

</div>