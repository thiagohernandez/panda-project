
<!-- Modal popups -->
<div class="container">
  <div class="modal fade" id="popup-holder" role="dialog">
    <div class="modal-dialog">
			<div class="modal-content">
				<?php $this->insert('pages/login/reminder') ?>
      </div>
    </div>
  </div>
</div>

<style>
#login-form-holder {
	text-align: center;
}
#login-form {
	display: inline-block;
	text-align: initial;
	margin-top: 50px;
	max-width: 320px;
	margin-left: auto;
	margin-right: auto;
}
#send-reminder {
	color: #00e;
	cursor: pointer;
}
@media (min-width: 768px) {
	#login-form {
		margin-top: 100px;
		max-width: 400px;
	}
}
.form-horizontal .form-group {
  margin-right: 0px;
  margin-left: 0px;
}
</style>
<div class="col-xs-12" id="login-form-holder">
	<div id="login-form">
		<div style="min-height: 20px;">
			<form class="form form-horizontal" action="<?= $_link('/login/login') ?>" method="post" style="min-height: 20px;">
				<div class="row">
					<div class="form-group" cols="col-xs-12">
						<input name="role" type="hidden" value="<?= $role ?>">
					</div>
					<div class="form-group" cols="col-xs-12">
						<label cols="col-sm-4"><?= $_($prompt) ?></label>
						<div cols="col-sm-8 col-xs-12">
							<input name="identifier" type="<?= $type?>" required autofocus>
						</div>
					</div>
					<div class="form-group" cols="col-xs-12" style="margin-bottom:0px;">
						<label cols="col-sm-4"><?= $_text('Password') ?></label>
						<div cols="col-sm-8">
							<input name="password" type="password" required>
						</div>
					</div>
					<div class="form-group" cols="col-xs-12">
						<div class="col-sm-4"> </div>
						<div class="col-sm-8">
							<p class="form-control-static pull-right" id="send-reminder">
								<?= $_text('LoginForgotPassword') ?>
							</p>
						</div>
					</div>
					<div style="display:none" class="checkbox sr-only">
						<label>
							<input value="remember-me" type="checkbox">Remember me</input>
						</label>
					</div>
					<div class="form-group" cols="col-xs-12">
						<div class="col-xs-12">
							<button type="submit" class="btn btn-primary pull-right"><?= $_text('LogIn') ?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	<?= $_inline_script('formhelper.js') ?>
	patchForm({
		name:'login-form',
		small:0,
		label_css: {},
		input_css: { color: 'red' }
	});
	
	var showPopup = function($name) {
		ordering = false;
		$(".popup-pane").hide("fast");
		$($name).show("fast");
		$("#popup-holder").modal("show");
	}

	$("#send-reminder").on("click",function() {
		console.log("Send reset...");
		showPopup("#popup-remind");
	});
</script>
