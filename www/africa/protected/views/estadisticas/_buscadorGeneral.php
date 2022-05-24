<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post','htmlOptions'=>array('class'=>'form-search')
)); ?>
<input name='ano' type='text' class='span1' value='<?=isset($_POST["ano"])?$_POST["ano"]:Date("Y")?>'></input>
<button type='submit' class='btn btn-primary'> <i class="icon-search icon-white"></i> </button>

<?php $this->endWidget(); ?>