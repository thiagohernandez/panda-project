<script>
	// Definir el tamaño de la barra del menu
	var $menu_bar_height = 70;
</script>

<!-- panda logo -->
<style>
.logo {
	margin-top: -2px;
	position: absolute;
	position: fixed!important;
	top:0px;
	left:60px;
	border-radius: 8px;
}
.logo img {
	border-radius: 8px;
}
#logo_back {
	z-index: 490;
	position: absolute;
	box-shadow: 2px 2px 10px #555;
}
#logo_front {
	position: absolute;
	z-index: 501;
}
</style>

<a href="/home" class="logo-big">
	<div class="logo" id="logo_back">
		<img src="/home/img/menubar_logo.png" alt="Broker Panda">
	</div>
	<div class="logo" id="logo_front">
			<img src="/home/img/menubar_logo.png" alt="Broker Panda"></a>
	</div>
</a>
<a href="/home" class="logo-sm">
	<div class="logo" id="logo_back">
		<img src="/home/img/menubar_logo_sm.png" alt="Broker Panda">
	</div>
	<div class="logo" id="logo_front">
			<img src="/home/img/menubar_logo_sm.png" alt="Broker Panda"></a>
	</div>
</a>

<style>
#header_outer {
	position: fixed;
	width:100%;
	background:#ffffff;
	padding-top:14px;
	box-shadow: 2px 2px 10px #555;
	z-index: 500!important;
	height: 80px;
	vertical-align: middle;
}
#how-it-works-holder {
	padding-top:6px;
	display:inline-block;
}
#language-holder {
	float: right;
	padding-right: 20px;
	display:inline-block;
}
.back-arrow {
	display: inline-block;
	height: 16px;
	font-size: 16px;
	padding-right: 4px;
}
</style>

<header id="header_outer">
	<div id="language-holder">
		<?php if ($language_name != "en") { ?>
			<a href="/home/<?= $page_to_serve ?>?lang=en"><img src="/home/img/flag-en.png"></a>
		<?php } ?>
		<?php if ($language_name != "es") { ?>
			<a href="/home/<?= $page_to_serve ?>?lang=es"><img src="/home/img/flag-es.png"></a>
		<?php } ?>
	</div>
	<?php if ($page_to_serve == '') { ?>
		<div id="how-it-works-holder">
			<button class="btn btn-default" id="how-it-works-button"><?= txt('how_it_works') ?></button>
		</div>
	<?php } else { ?>
		<div id="how-it-works-holder">
			<button class="btn btn-default" id="go-back-button"><div class='back-arrow'>&laquo;</div><?= txt('go_back') ?></button>
		</div>
	<?php } ?>
</header>

<script>
var adjustMenuBar = function() {
	console.log("adjustMenuBar: "+window.innerWidth+'px');
	$('#header_outer').css('height',$menu_bar_height);
	$('#header_outer').css('width',''+window.innerWidth+'px');
	if (window.innerWidth > <?= $menu_shrink_width ?>) {
		$(".logo-big").show();
		$(".logo-sm").hide();
		$('.logo').css('left','60px');
		$("#header_outer").css('padding-left','320px');
		$("#how-it-works-button").removeClass('btm-sm');
	}
	else {
		$(".logo-big").hide();
		$(".logo-sm").show();
		$('.logo').css('left','5px');
		$("#header_outer").css('padding-left','90px');
		$("#how-it-works-button").removeClass('btm-sm');
	}
	if (window.innerWidth > 320) {
		$("#language-holder").css('padding-right','20px');
	}
	else {
		$("#language-holder").css('padding-right','8px');
	}
}
adjustMenuBar();
$(window).resize(adjustMenuBar);

var setHowItWorksHeight = function() {
	console.log("Setting help height");
	$d = 130;
	if (window.innerWidth < 400) {
		$d = 110;
	}
	$('#how-it-works-height').css('height',''+(window.innerHeight-$d)+'px');
};
$(window).resize(setHowItWorksHeight);
$("#how-it-works-button").on('click', function() {
	console.log('Clicked on how-it-works');
	setHowItWorksHeight();
	$("#how-it-works").modal("show");
});
$("#go-back-button").on('click', function() {
	window.location = "/home";
});
</script>

<style>
	.modal-body {
		background:#fff;
	}
	.modal-open {
    overflow: visible;
	}
	.modal-open, .modal-open .navbar-fixed-top, .modal-open .navbar-fixed-bottom {
    padding-right:0px!important;
	}
	.how-it-closes {
		display: inline-block;
		width: 24px;
		height: 24px;
		font-size: 20px;
		border: 1px solid grey;
		border-radius: 5px;
		padding-top: 2px;
	}
	.modal-title {
		margin: 0px;
	}
	.how-heading, .how-number.li {
		font-size: 16px;
		font-weight: bold;
	}
	.how-image {
		padding-top: 0px;
		padding-bottom: 12px;
		max-width: 100%;
	}
	.how-image>img {
		max-width: 100%;
	}
</style>

<?php
	if ($language_name === "es") {
		require ("how_it_works_es.php");
	}
	else {
		require ("how_it_works_en.php");
	}
?>
<script>
var setModalSize = function() {
	$(".modal-size").css('max-width',''+(window.innerWidth-20)+'px');
}
$("#how-it-works-button").on('click', function() {
	console.log('Clicked on how-it-works');
	setModalSize();
	$("#how-it-works").modal("show");
});
</script>
