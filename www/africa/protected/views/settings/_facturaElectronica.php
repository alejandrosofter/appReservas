<h3>Factura ELECTRONICA AFIP</h3>
<div class="content-form">

<div class="">
		<b><?php echo 'PK' ?></b>
		<?php echo CHtml::textArea('FACTURAELECTRONICA_PK',Settings::model()->getValorSistema('FACTURAELECTRONICA_PK'),array('class'=>'text','rows'=>'10','style'=>"width:90%"));?>
</div>
<div class="">
		<b><?php echo 'PEDIDO' ?></b>
		<?php echo CHtml::textArea('FACTURAELECTRONICA_CSR',Settings::model()->getValorSistema('FACTURAELECTRONICA_CSR'),array('class'=>'text','rows'=>'10','style'=>"width:90%"));?>
</div>
<div class="">
		<b><?php echo 'CERTIFICADO DIGITAL' ?></b>
		<?php echo CHtml::textArea('FACTURAELECTRONICA_CERT',Settings::model()->getValorSistema('FACTURAELECTRONICA_CERT'),array('class'=>'text','rows'=>'10','style'=>"width:90%"));?>
</div>
<div class="">
<!-- link para escribir certificados -->
<a class="btn btn-primary" onclick="writeCertificado()">Escribir Certificados</a>
<span id="resCertificados"/>	 
</div>
</div>
<script>
function writeCertificado(){
    $.getJSON('index.php?r=facturasElectronicas/escribirCertificados', function(data,error) {
        $("#resCertificados").html(data.msg);
})
}
</script>