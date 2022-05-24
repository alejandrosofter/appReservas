<header id="page-header">
<h1 id="page-title">Bienvenido a COVISERCO</h1>
</header>
<div style="float:right"><a class="button green large" href="index.php?r=mensajes/create">Enviar Mensaje</a></div>
<div class="two-thirds">
	<?php echo $this->renderPartial('/comunicados/_ultimosComunicados'); ?>
</div>
<div class="one-third column-last">
<?php echo $this->renderPartial('/mensajes/_ultimosMensajes'); ?>
</div>

