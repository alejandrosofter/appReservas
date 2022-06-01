<div id='formularioCreate' class="row">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reservas-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($model,isset($_GET['idCliente'])?'nombreCumpleano':'idCliente')
)); ?>

	<p class="note">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="span3">
<h3>Datos de la Reserva</h3>
<?php echo $form->textField($model,'id',array('TYPE'=>'hidden')); ?>
<div class="">
						<?php echo $form->labelEx($model,'fecha',array('class'=>'')); ?>
						<?php echo $form->textField($model,'fecha',array('class'=>'span2','size'=>60,'maxlength'=>255)); ?>
						<?php echo $form->error($model,'fecha'); ?>
					</div>

                  	<div class="">
						<?php echo $form->labelEx($model,'idCliente',array('class'=>'')); ?>
						<?php echo $form->dropDownList($model,'idCliente',CHtml::listData(Clientes::model()->findAll(), 'id', 'nombres'),array ('prompt'=>'Cliente','onchange'=>'cambiaCliente()','class'=>'chzn-select','style'=>'width:100%')); ?>
						<?php echo $form->error($model,'idCliente'); ?>
					</div>

					<div class="">
						<?php echo $form->labelEx($model,'nombreCumpleano',array('class'=>'')); ?>
						<?php echo $form->textField($model,'nombreCumpleano',array('class'=>'','size'=>60,'maxlength'=>255)); ?>
						<?php echo $form->error($model,'nombreCumpleano'); ?>
					</div>

					<div class="">
						<?php echo $form->labelEx($model,'idTipoReserva',array('class'=>'')); ?>
						<?php echo $form->dropDownList($model,'idTipoReserva',CHtml::listData(ReservasTipos::model()->findAll(), 'id', 'nombreTipoReserva'),array ('style'=>'width:100%')); ?>
						<?php echo $form->error($model,'idTipoReserva'); ?>
					</div>
					
</div>
<div class="span6"><?=$this->renderPartial('servicios',array('model'=>$model))?></div>
<div class="span3 pull-right"><?=$this->renderPartial('tareas',array('model'=>$model))?></div>
<div class="span3 pull-right"><?=$this->renderPartial('pagos',array('model'=>$model))?>
<?=!isset($nuevo)?"<span class='text-warning'>En las modificaciones de reserva <b>no se pueden modificar los pagos</b></span>":""?>
</div>

<?php $this->endWidget(); ?>

<br><br>
<div id='errores' class='span9' style='display:none'>
	<div class="alert alert-block alert-error fade in">
	            <div id='contenidoError'></div>
	 </div>
</div>
<div id='printer' style='display:none'></div>
<a id='btnAceptar' href="#" style="width:90%" onclick="<?=isset($nuevo)?'agregarReserva()':'actualizaReserva()'?>" class='btn btn-primary'>Aceptar</a>
</div>
