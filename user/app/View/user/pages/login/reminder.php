<!-- Password reminder modal -->
<div class="popup-pane" id="popup-remind">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title text-center"><?= $_text('LoginRecoverPassword') ?></h4>
	</div>
	<div class="modal-body" style="min-width:300px;">
		<div class="row">
			<div class="col-xs-12">
				<?= $_text('LoginRecoverEnterEmail') ?>
			</div>
			<div class="col-xs-12">
				<div>&nbsp;</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="reminder-mail"><?= $_text('LoginEmailAddress') ?></label>
					<input name="identifier" class="form-control" type="email" id="reminder-mail" required="" autofocus="1">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<button id="remind-button" type="button" class="btn btn-primary pull-right"><?= $_text('LoginSend') ?></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="popup-pane" id="reminder-sending">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?= $_text('LoginSendingEmail') ?></h4>
	</div>
	<div class="modal-body" style="min-width:300px;">
		<div class="row">
			<div class="col-xs-12">
				<p><?= $_text('LoginPleaseWait') ?></p>
			</div>
		</div>
	</div>
</div>

<div class="popup-pane" id="reminder-sent">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?= $_text('LoginEmailSent') ?></h4>
	</div>
	<div class="modal-body" style="min-width:300px;">
		<div class="row">
			<div class="col-xs-12">
				<p><?= $_text('LoginCheckInbox') ?></p>
			</div>
		</div>
	</div>
</div>

<div class="popup-pane" id="reminder-fail">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title"><?= $_text('Error') ?></h4>
	</div>
	<div class="modal-body" style="min-width:300px;">
		<div class="row">
			<div class="col-xs-12">
				<p><?= $_text('LoginNoSuchEmail') ?></p>
			</div>
		</div>
	</div>
</div>

<script>
	$('#remind-button').on('click',function() {
		var $email = $('#reminder-mail').val();
		console.log("Remind me! "+$email);
		if ($email.length > 0) {
			$(".popup-pane").hide("fast");
			$('#reminder-sending').show("fast");
			$url = "<?= $_link("/login/send_reminder") ?>";
			$data = { email:$email };
			$.post($url, $data, function($result) {
				console.log("Ajax returned: "+$result);
				$("#popup-holder").modal("show");
				$(".popup-pane").hide("fast");
				try {
					$result = JSON.parse($result);
					console.log($result);
					if ($result.success) {
						$('#reminder-sent').show("fast");
					}
					else {
						$('#reminder-fail').show("fast");
					}
				}
				catch ($err) {
					$('#reminder-fail').show("fast");
				}
			})
			.fail(function($jqXHR, $textStatus, $errorThrown) {
				$("#popup-holder").modal("show");
				$(".popup-pane").hide("fast");
				$('#reminder-fail').show("fast");
			});
		}
	});
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
