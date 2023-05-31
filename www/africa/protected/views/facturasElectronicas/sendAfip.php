<h1>Enviando a AFIP</h1>
<?=$_view?>
<div class="row ">
    <div class="span2">
        <img style="display:none" id="loadingImg" src="images/loading.gif" alt="loading" />
        <?php
        if($model->estado==="PENDIENTE"){?>
        <button id="btnAfip" class="btn btn-primary" onclick="enviarAfip()"><i class="icon-share icon-white"></i> Enviar a AFIP</button>
        <?php }?>
    </div>
    <div class="span2">
    <?php
        if($model->estado==="PENDIENTE"){?>
      <a id="botonEditar" class="btn btn-success"  href="index.php?r=facturasElectronicas/update&id=<?=$model->id?>&andSend"><i class="icon-pencil icon-white"></i> Editar Comprobante</a>
      <?php }?>
    </div>
    <div class="span2">
    <?php
        if($model->estado==="COMPLETADO"){?>
        <button id="btnImprimir" class="btn btn-info" onclick="imprimir()"><i class="icon-print icon-white"></i> IMPRIMIR</button>
        <?php }?>    </div>

</div>

<div id="mensajeError" style="display:none" class="alert alert-danger" role="alert"></div>
<script>
init()
function init()
{
	// enviarAfip()
}
function imprimir()
{
    // loca("index.php?r=facturasElectronicas/imprimir&id=<?=$model->id?>");
    location.href="index.php?r=facturasElectronicas/imprimir&id=<?=$model->id?>";
}
function enviarAfip()
{
    $("#mensajeError").hide()
    $("#btnAfip").hide()
    $("#loadingImg").show()
    $.getJSON('index.php?r=facturasElectronicas/enviarAfip',{id:<?=$model->id;?>}, function(data,error) {
        imprimir()
})
.error(function(jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
        $("#mensajeError").show()
        $("#btnAfip").show()
        $("#loadingImg").hide()
        $("#mensajeError").html(jqXHR.responseText);
    })

}
</script>