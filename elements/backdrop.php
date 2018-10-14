<style>
	#background-image {
		z-index: -100;
		left: 0px;
		top: 0px;
		width:100px;
		height:200px;
		position: absolute;
		background-size: cover;
		background-repeat: no-repeat;
		background-image: url("/home/img/wallpaper/pandastreet.jpg");
	}
</style>
<div id="background-image">
</div>

<script>
	var $biggestBackgroundHeight = -1;
	var setBackdropHeight = function() {
		var $navbar = $("#doc-body").width();
		var $doc_height = $("#doc-body").height();
		var wh = $(window).height()-$menu_bar_height;
		var h = $('#doc-body').height();
		if (h < wh) {
			h = wh;
		}
		$backdrop = $('#background-image');
		$backdrop.css('top',''+$menu_bar_height+'px');
		$backdrop.css('min-width',''+$navbar+'px');
		$backdrop.css('min-height',''+h+'px');
	};
	//setBackdropHeight();
	$(window).resize(setBackdropHeight);
	$(document).ready(function() {
		setBackdropHeight();
	});
</script>


