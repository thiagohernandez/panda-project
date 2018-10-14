<div class="hidden-xs" style="display:block;height:50px;">
</div>
<div style="max-width:600px; margin:20px auto;">
 <div class="panel panel-default">
	<div class="panel-heading">
		<?= $_text('RecoverPassword') ?>
	</div>
	<div class="panel-body">
		<p>Por favor introduzca su direcci&oacute;n de correo electronic&oacute; abajo.</p>
		<p>Si es usted suscriptor, le enviaremos un vinculo para crear una contrase&ntilde;a nueva.</p>
		<div>
			<form class="form" action="<?= $_link('/login/recover_password')?>" method="GET">
				<div class="form-group">
					<label for="email-input" class="control-label">Email</label>
					<input name="email" id="email-input" type="email" value="" class="form-control" required>
				</div>
				<div>
					<button class="btn btn-primary pull-right" id="send-button">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$("#send-button").on('click', function() {
		console.log('sending...');
		$(".panel-heading").text('Enviando correo');
		$(".panel-body").html('<p>Un momento por favor...</p>');
		$('html').css('cursor','wait');
	});
</script>

