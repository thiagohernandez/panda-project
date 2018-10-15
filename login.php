    <section class="section-login">
    	<div class="section-login__inner box-default">
	    	<div class="container-fluid">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="padding__inner">
	    					<h1>Login</h1>
							
							<form id="login-form" class="form" accept-charset="ISO-8859-1">
								<p class="error_message" id="error_message"></p>
	    						<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="far fa-envelope-open"></i></div>
										</div>
										<input class="form-control" type="email" name="email" id="email_input" value="<?= $cookie_email ?>" placeholder="<?= txt('email') ?>">
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group input-group__transparent">
										<div class="input-group-prepend">
											<div class="input-group-text"><i class="fas fa-key"></i></div>
										</div>
										<input class="form-control" type="password" name="password" id="password_input" placeholder="<?= txt('password_o') ?>">
									</div>	
								</div>
								<button class="btn btn-primary pull-right" type="submit"><?= txt('acceder')?></button> 
								<p class="my-4">
									<a href="javascript:void(0);" class="link-stats" data-toggle="modal" data-target="#modalRecoverPassword">
										<?= txt('olvidadomiclave') ?>
									</a>
								</p>
								<hr>
								<h5 class="title-smaller my-4"><?= txt('notengo') ?></h5>
								<?php if ($language_name != "en") { ?>
									<a href="/home/crear-cuenta" class="btn btn-light-gray"><?= txt('create_account') ?></a>
								<?php }else{ ?>
									<a href="/home/crear-cuenta?lang=en" class="btn btn-light-gray"><?= txt('create_account') ?></a>
								<?php } ?>
								
							</form>
	    				</div>
	    			</div>
	    			<div class="col-md-6 bg-login bg-cover">
	    				<div class="padding__inner">
	    					<h2><?= txt('nuncaduermen') ?></h2>
							<p><strong><?= txt('optimizadas247') ?></strong> <?= txt('pornuestrosrobo') ?></p>
							<p><strong><?= txt('alertaspanda') ?></strong> <?= txt('porcorreoelectronico') ?></p>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
    	</div>
    </section>

    <!-- MODAL RECOVER PASSWORD -->
    <!-- Modal -->
	<div class="modal fade" id="modalRecoverPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content ">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><?= txt('resetpassword') ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?= txt('introducetucorreo') ?></p>
					<form>
						<div class="form-group">
							<div class="input-group input-group__transparent">
								<div class="input-group-prepend">
									<div class="input-group-text"><i class="far fa-envelope-open"></i></div>
								</div>
								<input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email">
							</div>
						</div>
						
						<!-- <button type="submit" class="btn btn-primary">Entrar</button> -->
						<a href="dashboard.html" class="btn btn-primary"><?= txt('enviarcorreo') ?></a>
					</form>
				</div>
			</div>
		</div>
	</div>
	
<script>
	var $email = '';
	var $lang = "<?= $language_name ?>";
	var debug = function(msg) { console.log(msg); };
	var validate_email = function(email) {
	   return (email.length > 0) && (email.indexOf("@")>0);
	};
	var show_error = function($source) {
		//$('#'+$input).css('border-color','#ff3200');
		$('#error_message').html($('#'+$source).html());
		$('#error_message').fadeIn(300);
	};

	$("#login-form").on('submit', function(e) {
		debug('You want to login');
		e.preventDefault();
		$email = document.getElementById("email_input").value;
		$pass = document.getElementById("password_input").value;

		debug('Login...');
		debug('email='+$email);
		debug('pass='+$pass);
		debug('lang='+$lang);
		debug('validate email='+validate_email($email));

		if (validate_email($email)) {
			debug('Using AJAX to check login...');
			$.post(	"/users/ajax_login.json",
				{ email: $email, pass: $pass, lang: $lang },
				function( $result ) {
					debug("Data arrived at login_checker AJAX callback");
					debug(JSON.stringify($result));
					debug('result='+$result['result']);
					if ($result['result'] == "NEW!") {
						$('#new-free-account-prompt').html("<?= txt('create_new_account1') ?>"+$email+"<?= txt('create_new_account2') ?>");
						$("#new-account").modal("show");
					}
					else if ($result['result'] == "NC!") {
						$('#confirm-account-prompt').html("<?= txt('confirm_account1') ?>"+$email+"<?= txt('confirm_account2') ?>");
						$('#confirm-account-prompt2').html("<?= txt('confirm_check_email') ?>");
						$("#confirm-account-modal").modal("show");
					}
					else if ($result['result'] == "OK!") {
						window.top.location.href = $result['url'];
					}
					else {
						show_error("bad-login-text");
					}
				},
				"json"
			);
		}
		else {
			show_error("bad-email-text");
		}
		return false;		// Don't submit the form automatically
	});
</script>