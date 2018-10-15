<!-- Modal - passwords don't match -->
<div id="password-mismatch" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<p><?= $_text('LoginPasswordMismatch') ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?= $_text('Close') ?></button>
			</div>
		</div>
	</div>
</div>


<div id="reset-fail" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
				<p><?= $_text('UnknownError') ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><?= $_text('Close') ?></button>
			</div>
		</div>
	</div>
</div>

<script>
	function centerModal() {
		$(this).css('display', 'block');
		var $dialog  = $(this).find(".modal-dialog"),
		offset       = ($(window).height() - $dialog.height()) / 4,
		bottomMargin = parseInt($dialog.css('marginBottom'), 10);

		// Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
		if(offset < bottomMargin) offset = bottomMargin;
		$dialog.css("margin-top", offset);
	}
	$(document).on('show.bs.modal', '.modal', centerModal);
	$(window).on("resize", function () {
			$('.modal:visible').each(centerModal);
	});
</script>

<div id="page-content">
	<div id="top-padding" style="padding-top:30px"></div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<div  style="display:inline-block;max-width:500px; text-align:initial">
				<div class="panel panel-default" id="form-holder">
					<div class="panel-heading">
						<div class="panel-title">
							<?= $_text('LoginCreateNewPassword') ?>
							<button type="button" class="close" id="close-button">&times;</button>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<form id="reset-pass-form" class="form form-horizontal" action="javascript:validateForm()" method="post">
									<input type="hidden" id="token" value="<?= $_($token) ?>">

									<div class="form-group">
										<label class="control-label col-xs-5"><?= $_text('Password') ?></label>
										<div class="col-xs-7">
											<input name="password1" id="password1-input" class="form-control" type="password" value="" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-5"><?= $_text('RepeatPassword') ?></label>
										<div class="col-xs-7">
											<input name="password2" id="password2-input" class="form-control" type="password" value="" required>
										</div>
									</div>

									<div class="form-group">
										<div class="col-xs-12">
											<div class="pull-right">
												<button class="btn btn-primary"><?= $_text('Send') ?></div>
											</div>
										</div>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#close-button').on('click', function() {
		window.location.href = '<?= $_link("/") ?>';
	});

	// Form validation
	var validateForm = function() {
		var debug = function($msg) { console.log($msg);	}
		debug('You submitted the form!');
		// Validate: Passwords must match
		var $password1 = $('#password1-input').val();		debug('pass1='+$password1);
		var $password2 = $('#password2-input').val();		debug('pass2='+$password2);
		if ($password1 !== $password2) {
			$('#password-mismatch').modal();
		}
		else {
			// Send it off for validation
			var $token = $("#token").val();								debug("token="+$token);
			$url = "<?= $_link("/login/do_password_reset") ?>";
			$data = { token: $token, password:$password1 };
			$.post($url, $data, function($result) {
				debug("Ajax returned: "+$result);
				$result = JSON.parse($result);
				console.log($result);
				if ($result.success) {
					window.location = "<?= $_link('/user') ?>";
				}
				else {
					$('#reset-fail').modal();
				}
			})
			.fail(function($jqXHR, $textStatus, $errorThrown) {
				debug("Ajax failed! ("+$errorThrown+")");
			});
		}
	};
</script>

