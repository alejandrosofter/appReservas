<style>
.invalido {
	font-size: 13px;
	color: #fc1717;
}
</style>
<form action="index.php?r=site/login" method="POST" id="login-form">
		
			<fieldset>

				<p>
					<label for="login-username">nombre de usuario</label>
					<input type="text" name='username' id="login-username" class="round full-width-input" autofocus />
				</p>

				<p>
					<label for="login-password">clave</label>
					<input type="password" name='password' id="login-password" class="round full-width-input" />
				</p>
				<div class='invalido'><?=$invalido?'Datos para el ingreso incorrectos!':'';?></div>
				<a onclick="document.getElementById('login-form').submit()" class="button round blue image-right ic-right-arrow">INGRESAR</a>

			</fieldset>

			<br/><div class="information-box round">Haz click sobre "INGRESAR" para ingresar al sistema de Africa.</div>

		</form>
		<script>
		$('#login-password').keypress(function(e) {
    if(e.which == 13) {
        $('#login-form').submit();
    }
});
		</script>