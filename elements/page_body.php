<!-- page_body.php -->
<style>
	#page-backdrop {
		margin: 8px 0px;
		border-radius: 8px;
		padding-top: 12px;
	}
	.transparency {
		opacity: 0.96!important;
	}
	.tab-control {
		height: 40px;				/* Must match 'line-height' below */
		line-height: 40px;	/* Must match 'height' above */
		outline:0px!important;
	}
	.content-pane {
		min-height: 300px;
	}
	.nav-tabs {
		border: 0px;
	}
	.nav-tabs>li {
		margin-bottom:0px;
	}
	.nav>li>a {
		margin: 0px;
		padding: 0px 24px;
	}
	.nav-tabs h3 {
		color: black;
		font-size: 18px;
		margin: 0px;
	}
	.outer-pane {
		border-top-left-radius: 0px !important;
		border-bottom-left-radius: 12px !important;
		border-top-right-radius: 12px !important;
		border-bottom-right-radius: 12px !important;
	}
	.tab-control {
		border: 0px!important;
		margin-right: 2px;
		border-top-left-radius: 8px;
		border-top-right-radius: 8px;
	}
	.free-text {
		color: #fff!important;
		text-shadow: 1px 1px #398839;
	}
	.free-tab, .free-tab.active {
		background: #3baf3b!important;
	}
	#free-panel {
		background: #3baf3b;
		background: -moz-linear-gradient(top,  #3baf3b 0%, #005700 99%);
		background: -webkit-linear-gradient(top,  #3baf3b 0%,#005700 99%);
		background: linear-gradient(to bottom,  #3baf3b 0%,#005700 99%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3baf3b', endColorstr='#005700',GradientType=0 );
	}
	.pro-text {
		color: #fff!important;
		text-shadow: 1px 2px #205099;
	}
	.pro-tab, .pro-tab.active {
		background: #275899!important;
	}
	#pro-panel {
		background: #275899;
		background: -moz-linear-gradient(top,  #275899 0%, #134d99 100%);
		background: -webkit-linear-gradient(top,  #275899 0%,#134d99 100%);
		background: linear-gradient(to bottom,  #275899 0%,#134d99 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#275899', endColorstr='#134d99',GradientType=0 );
	}
	.club30-text {
		color: #002!important;
	}
	.club30-tab, .club30-tab.active {
		background: #f9c667!important;
	}
	#club30-panel {
		background: #f9c667;
		background: -moz-linear-gradient(top,  #f9c667 0%, #f79621 100%);
		background: -webkit-linear-gradient(top,  #f9c667 0%,#f79621 100%);
		background: linear-gradient(to bottom,  #f9c667 0%,#f79621 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9c667', endColorstr='#f79621',GradientType=0 );
	}
	.error_message {
		display:none;
		color: white;
		background: red;
		padding: 4px 12px;
		border-radius: 4px;
		width: 100%;
	}
	.error_message a {
		color: #04f;
	}
	.content-pane {
		padding: 15px;
	}
	.input-holder {
	}
	.content-pane input {
		width: 100%;
		padding-left: 5px;
		margin-bottom: 5px;
		height: 36px;
		border: 1px solid #888; 
		border-radius: 2px;
	}
	.panda-badge {
		float:right;
	}
	.content-holder {
		padding-top: 30px;
	}
	.big-text {
	}
	.medium-text {
	}
	.text-divider {
		display: block;
		height: 10px;
	}
	.info-email {
		display: inline-block;
		color:#fff;
		background-color: #f44;
		border-radius: 8px;
		padding: 12px;
		text-shadow: none;
	}
	.club30-button {
		color: #fff!important;
		border: 1px solid #800;
		background: #ff3019;
		background: -moz-linear-gradient(top,  #ff3019 0%, #cf0404 100%);
		background: -webkit-linear-gradient(top,  #ff3019 0%,#cf0404 100%);
		background: linear-gradient(to bottom,  #ff3019 0%,#cf0404 100%);
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 );
	}
@media screen and (max-width: <?= $tab_shrink_width ?>px) {
	.tab-control {
		height: 32px;				/* Must match 'line-height' below */
		line-height: 32px;	/* Must match 'height' above */
	}
	.nav-tabs h3 {
		font-size: 14px;
		font-weight: bold;
	}
	.nav>li>a {
		padding: 0px 6px 0px 8px;
	}
	.tab-control {
		margin-right: 1px;
	}
	.content-holder {
		padding-top: 12px;
	}
}
@media screen and (max-width: 375px) {
	.nav-tabs h3 {
		font-size: 11px;
		font-weight: normal;
	}
	.nav>li>a {
		padding: 0px 6px 0px 8px;
	}
	.tab-control {
		margin-right: 1px;
	}
	.content-holder {
		padding-top: 8px;
	}
}
</style>

<div class="content-holder" style="max-width:<?= $max_content_width ?>px">
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<div id="page-content">
						<div class="row">
							<div class="col-xs-12">
								<ul class="nav nav-tabs tab-control transparency" style="position:relative; top:0px; overflow:hidden;">
									<li role="presentation" class="tab-control free-tab active">
										<a href="#free-tab" aria-controls="free-tab" role="tab" data-toggle="tab" class="tab-control free-tab">
											<h3 class="tab-control free-text"><?= txt('panda_free_tab') ?></h3>
										</a>
									</li>
									<li role="presentation" class="tab-control pro-tab">
										<a href="#pro-tab" aria-controls="pro-tab" role="tab" data-toggle="tab" class="tab-control pro-tab">
											<h3 class="tab-control pro-text"><?= txt('panda_pro_tab') ?></h3>
										</a>
									</li>
									<li role="presentation" class="tab-control club30-tab">
										<a href="#club30-tab" aria-controls="club30-tab" role="tab" data-toggle="tab" class="tab-control club30-tab">
											<h3 class="tab-control club30-text"><?= txt('panda_club30_tab') ?></h3>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="tab-content">
									<div role="tabpanel" class="transparency tab-pane fade in active" id="free-tab">
										<div class="outer-pane" id="free-panel">
											<div class="content-pane transparency">
												<div class="panda-badge">
													<img class="badge-img" src="/home/img/silver_badge.png">
												</div>
												<div class="free-text">
													<h2 class="big-text"><?= txt('free_first_club') ?></h2>
													<h4 class="medium-text"><?= txt('free_robotraders') ?></h4>
												</div>
												<div style="max-width:350px;margin-top:32px;">
													<form id="login-form" class="form" accept-charset="ISO-8859-1">
														<p class="free-text small-text"><?= txt('free_enter_email') ?></p>
														<p class="error_message" id="error_message"></p>
														<div class="input-holder">
															<input style="display:block;width:100%!important" type="email" name="email" id="email_input" value="<?= $cookie_email ?>" placeholder="<?= txt('email') ?>"></input>
														</div>
														<div class="input-holder">
															<input type="password" name="password" id="password_input" placeholder="<?= txt('password_o') ?>"></input>
														</div>
														<div class="input-holder">
															<button class="btn btn-primary pull-right" type="submit"><?= txt('send')?></button> 
														</div>
														<p class="reg_status"></p>
													</form>
												</div>
												<div class="clearfix visible-xs-block"></div>
												<br clear="both">
											</div>
										</div>
									</div>
									<div role="tabpanel" class="transparency tab-pane fade" id="pro-tab">
										<div class="outer-pane" id="pro-panel">
											<div class="content-pane transparency pro-text">
												<div class="panda-badge">
													<img class="badge-img" src="/home/img/gold_badge.png">
												</div>
												<div>
													<h2 class="big-text"><?= txt('pro_text1') ?></h2>
													<div class="text-divider"></div>
													<h3 class="medium-text"><?= txt('pro_text2') ?></h3>
													<h3 class="medium-text"><?= txt('pro_text3') ?></h3>
													<h3 class="info-email"><tt>info@brokerpanda.com</tt></h3>
												</div>
											</div>
											<div class="clearfix visible-xs-block"></div>
											<br clear="both">
										</div>
									</div>
									<div role="tabpanel" class="transparency tab-pane fade" id="club30-tab">
										<div class="outer-pane" id="club30-panel">
											<div class="content-pane club30-text">
												<div class="panda-badge">
													<img class="badge-img" src="/home/img/club_30.png">
												</div>
												<div>
													<h2 class="big-text"><?= txt('club30_text1') ?></h2>
													<div class="text-divider"></div>
													<h3 class="medium-text"><?= txt('club30_text2') ?></h3>
												</div>
											</div>
											<div style="max-width:500px;text-align:center">
												<button class="btn btn-lg club30-button" id="join-club-30"><?= txt('join_club30') ?></button>
											</div>
											<div class="clearfix visible-xs-block"></div>
											<br clear="both">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="clearfix visible-xs-block"></div>
<br clear="both">

<script>
var adjustBadges = function() {
	console.log("window.innerWidth="+window.innerWidth);
	$('#header_outer').css('height',$menu_bar_height);
	var $ss = 400;	// Shrink start
	var $se = 800;	// Shrink end
	var $size = 96;	// Smallest size
	var $ww = window.innerWidth;
	if ($ww > $ss) {
		if ($ww > $se) {
			$size = 256;
		}
		else {
			$size += ((256-$size)*($ww-$ss))/($se-$ss);
		}
	}
	$(".badge-img").css('width',''+$size+'px');
	$(".panda-badge").css('width',''+$size+'px');
	if ($ww < 500) {
		$(".big-text").css('font-size','24px');
		$(".medium-text").css('font-size','14px');
		$(".small-text").css('font-size','12px');
		$(".info-email").css('font-size','14px');
	}
	else {
		$(".big-text").css('font-size','30px');
		$(".medium-text").css('font-size','18px');
		$(".small-text").css('font-size','14px');
		$(".info-email").css('font-size','20px');
	}
}
adjustBadges();
$(window).resize(adjustBadges);
</script>


<!-- Modal dialogs (popups) -->
<style>
.wide-button {
	padding-left: 20px;
	padding-right: 20px;
}
h3.modal-title {
	text-align: left;
}
</style>

<!-- New account? -->
<div class="modal fade" id="new-account" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('new_email_title') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('email_not_found') ?></p>
						<p id="new-free-account-prompt"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="yes-new-button"><?= txt('yes')?></button>
					<span style="display:inline-block;width:32px;"></span>
					<button class="btn btn-danger wide-button" id="no-new-button"><?= txt('no')?></button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Choose account type -->
<div class="modal fade" id="choose-account-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('choose_account_title') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('choose_account_type') ?></p>
						<form class="form" onSubmit="return false;" accept-charset="ISO-8859-1">
							<div class="form-group">
								<div class="radio">
									<label><input type="radio" name="account-type" value="free" checked><?= txt('account_type_free')?></label>
								</div>
								<div style="height:2px">
								</div>
								<div class="radio">
									<label><input type="radio" name="account-type" value="code"><?= txt('account_type_code')?></label>
								</div>
								<div>
									<span id="code-prompt" style="display:inline-block;padding-left: 40px;"><?= txt('invitacion_code_prompt')?></span>
									<input name="invitation-code" class="form-control" value="" style="display:inline-block; max-width:100px">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="create-account-button"><?= txt('create_account')?></button>
					<span style="display:inline-block;width:32px;"></span>
					<button class="btn btn-danger wide-button" id="cancel-create-button"><?= txt('cancel')?></button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// Enable/disable the code input box
	updateAccountType = function() {
		console.log("updateAccountType()");
		var $type = $("input:radio[name=account-type]:checked").val();
		var $codeInput = $('input[name=invitation-code]');
		console.log("Account type is "+$type);
		if ($type == 'code') {
			$codeInput.removeAttr('disabled');
			$('#code-prompt').css('color','');
		}
		else {
			$codeInput.attr('disabled',1);
			$('#code-prompt').css('color','#eee');
		}
		$codeInput.css('border','');
	};
	$("input:radio[name=account-type]").change(function() {
		console.log("You changed the account type");
		updateAccountType();
	});
</script>

<!-- Check inbox for confirmation email -->
<div class="modal fade" id="account-created-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('account_created') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('email_sent') ?> <?= txt('check_inbox') ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="new-account-created-button">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Account not confirmed... -->
<div class="modal fade" id="confirm-account-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('not_confirmed_title') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p id="confirm-account-prompt"></p>
						<p id="confirm-account-prompt2"></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="confirm-ok-button">OK</button>
					<span style="display:inline-block;width:32px;"></span>
					<button class="btn btn-danger wide-button" id="confirm-resend-button"><?= txt('send_another_email')?></button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Confirmation email has been resent -->
<div class="modal fade" id="email-resent-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('email_resent') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('confirm_check_email') ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="new-account-created-button">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- You forgot your password -->
<div class="modal fade" id="forgot-password-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('reset_password_title') ?></h3>
					</div>
				</div>
			</div>
			<form class="form" onSubmit="return send_password_reset()" accept-charset="ISO-8859-1">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<p><?= txt('enter_email_for_reset') ?></p>
								<div class="input-holder">
									<input style="disply:inline-block;width:100%" type="email" name="email" id="reset_email_input" value="<?= $cookie_email ?>" placeholder="<?= txt('email') ?>"></input>
								</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit"><?= txt('send_email')?></button> 
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Check inbox for reset email -->
<div class="modal fade" id="password-reset-sent-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('email_resent') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('check_inbox') ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="reset-sent-ok-button">OK</button>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
body {
padding-right: 0px !important;/* Fix bug in bootstrap modal*/
}
</style>

<div style="display:none">
<div id="bad-login-text">
<p><?= txt('no_such_email') ?>&nbsp;
<a href="javascript:forgot_password()"><?= txt('forgot_email') ?></a></p>
</div>
<p id="bad-email-text">
<?= txt('bad_email') ?>
</p>
</div>
<?php if ($dev_mode) { ?>
<p><a href="javascript:forgot_password()"><?= txt('forgot_email') ?></a></p>
<?php } ?>

<!-- Club 30 -->
<div class="modal fade" id="club30-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-size" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="row">
					<div class="col-xs-12" style="text-align:center">
						<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="modal-close">&times;</span>
						</button>
						<h3 class="modal-title"><?= txt('club30_title') ?></h3>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<p><?= txt('club30_description') ?></p>
						<p><?= txt('club30_prices') ?></p>
						<ul>
							<li>2&nbsp;<?= txt('club30_months') ?>&nbsp;150&euro;</li>
							<li>6&nbsp;<?= txt('club30_months') ?>&nbsp;250&euro;</li>
							<li>12&nbsp;<?= txt('club30_months') ?>&nbsp;490&euro;</li>
						</ul>
						<p><?= txt('club30_more_info') ?></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="text-center">
					<button class="btn btn-success wide-button" id="club30-ok-button">OK</button>
				</div>
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

forgot_password = function() {
	debug("You forgot your password");
	$("#forgot-password-modal").modal("show");
};
send_password_reset = function() {
	debug("You want to reset your password");
	$email = document.getElementById("reset_email_input").value;
	debug("email:"+$email);
	if (validate_email($email)) {
		// Register using AJAX
		debug("requesting reset: "+$email);
		$.post(	"/users/ajax_send_password_reset.json",
			{ email: $email, lang: $lang },
			function( $result ) {
				debug("Data arrived at AJAX reset_password callback");
				debug(JSON.stringify($result));
				if ($result['result'] == "OK!") {
					$("#forgot-password-modal").modal("hide");
					$("#password-reset-sent-modal").modal("show");
				}
			},
			"json"
		);
	}
	return false;
}
$('#reset-sent-ok-button').on('click', function() {
	$("#password-reset-sent-modal").modal("hide");
});

<?php	if ($dev_mode) { ?>
// Cosas del desarollador
$(document).ready(function() {
	$email = 'panda22@artlum.com';
	//$('#new-free-account-prompt').html("<?= txt('create_new_account1') ?><tt><b>"+$email+"</b></tt><?= txt('create_new_account2') ?>");
	//$("#new-account").modal("show");
	//$("#account-created-modal").modal("show");
});
<?php } ?>

restoreCreateDialog = function() {
	$("#choose-account-modal").find('*').removeAttr('disabled');
};
$('#yes-new-button').on('click', function() {
	debug("You clicked yes");
	updateAccountType();
	restoreCreateDialog();
	$("#new-account").modal("hide");
	$("#choose-account-modal").modal("show");
});

$('#no-new-button').on('click', function() {
	debug('You clicked no');
	$("#new-account").modal("hide");
});

$('#cancel-create-button').on('click', function() {
	debug('You clicked cancel create');
	$("#choose-account-modal").modal("hide");
});

$('#create-account-button').on('click', function() {
	$("#choose-account-modal").find('*').attr('disabled',1);
	debug('You want to create an account');
	debug('Email address is: '+$email);
	var $type = $('input[name=account-type]:checked').val();
	$codeHolder = $('input[name=invitation-code]');
	var $code = $codeHolder.val();
	console.log('Account type is: '+$type);
	console.log('Code is: '+$code);
	// Register using AJAX
	$.post(	"/users/ajax_register.json",
		{ email: $email, type: $type, code: $code, lang: $lang, pass:'' },
		function( $result ) {
			debug("Data arrived at register AJAX callback");
			debug("$result="+$result);
			debug(JSON.stringify($result));
			if ($result['result'] == "BC!") {
				restoreCreateDialog();
				$codeHolder.css('border', '2px solid red');
			}
			else {
				$("#choose-account-modal").modal("hide");
				if ($result['result'] == "OK!") {
					$("#account-created-modal").modal("show");
				}
				else if ($result['result'] == "YA!") {
					$("#account-created-modal").modal("show");
				}
			}
		},
		"json"
	);
});

$('#new-account-created-button').on('click', function() {
	debug('You clicked OK');
	$("#account-created-modal").modal("hide");
});
$('#confirm-ok-button').on('click', function() {
	debug('You clicked confirm-OK');
	$("#confirm-account-modal").modal("hide");
});
$('#confirm-resend-button').on('click', function() {
	debug('You clicked confirm-resend');
	$.post(	"/users/ajax_resend.json",{ email: $email, lang: $lang },
		function($result) {
			debug("Confirmation email resent!");
		}
		,"json"
	);
	$("#confirm-account-modal").modal("hide");
	$("#email-resent-modal").modal("show");
});

$('#join-club-30').on('click', function() {
	debug('You want Club30');
	setModalSize();		// In "menu_bar.php"
	$("#club30-modal").modal("show");
});
$('#club30-ok-button').on('click', function() {
	debug('You clicked OK');
	$("#club30-modal").modal("hide");
});

</script>
