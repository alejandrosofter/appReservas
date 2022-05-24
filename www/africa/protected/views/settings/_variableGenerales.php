<h3>GENERAL</h3>
<div class="content-form">
<h3>MAILS</h3>

		<p><?php echo 'Host de Cuenta de MAIL' ?>
		<?php echo CHtml::textField('GENERALES_MAIL_HOST',Settings::model()->getValorSistema('GENERALES_MAIL_HOST'),array('class'=>'text','maxlength'=>64));
		
		 ?>
		</p>
		<p><?php echo 'Nombre de Cuenta' ?>
		<?php echo CHtml::textField('GENERALES_MAIL_CUENTA',Settings::model()->getValorSistema('GENERALES_MAIL_CUENTA'),array('class'=>'text','maxlength'=>64));
		
		 ?>
		
		<span class='help-block'><b>NOTA: </b>Nombre de la cuenta tal cual se escribe al ingresar.</span>
		
	</p>
<div class="row">
		<b><?php echo 'Clave de Cuenta' ?></b>
		<?php echo CHtml::textField('GENERALES_MAIL_CLAVE',Settings::model()->getValorSistema('GENERALES_MAIL_CLAVE'),array('class'=>'text','maxlength'=>64));
		
		 ?>
	</div>

<div class="row">
		<b><?php echo 'Envio de MAILS (general)' ?></b>
		<?php echo  CHtml::dropDownList('GENERALES_MAIL_ACTIVOGENERAL',Settings::model()->getValorSistema('GENERALES_MAIL_ACTIVOGENERAL'),Settings::model()->getEstadosAlertas());?>
		

		
		<span class='help-block'><b>NOTA: </b>Desactiva o Activa el envio de mails .</span>
		
	</div>
</div>