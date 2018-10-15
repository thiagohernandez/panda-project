<style>
.help-panel {
	display:inline-block;
	position: relative;
	width: 160px;
}
.help-title {
	font-weight: bold;
	position:relative;
	top:-32px;
	white-space: nowrap;
}
.helpbox {
	display:inline-block;
	position: absolute;
	width: 48px;
	height: 48px;
	border: 2px solid #bbb;
	border-radius: 6px;
	background-image: url("/img/globos/footprint.png");
	background-size: 100% 100%;
	font-weight: 700;
	opacity: 0.7;
}
.helpbox label {
	line-height: 50%;
	padding-top: 60%;
	text-align: center;
	vertical-align: middle;
	font-size: 16px;
	color: white;
}
.helpBox div {
	font-size: 14px;
	display:inline-block;
	max-width: 600px;
}
.helpBox h3 {
	padding-bottom: 26px!important;
}
</style>
<div class="help-panel">
	<div style="position:absolute;top:60px;left:20px">
		<div class="help-title">
			&iquest;Como functiona?
		</div>
		<div class="helpbox" style="top:0px; left:40px;">
			<label>1</label>
			<div class="help1" style="display:none" align="right">
				<div>
					<div style="max-width:568px">
						<div>
							<h3>1) <?= $text->help1title ?></h3>
							<div>
								<p><?= $text->help1text1 ?></p>
							</div>
						</div>
						<img src="/img/globos/markets.png">
						<div>
							<p><?= $text->help1text2 ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="helpbox" style="top:60px; left:0px;">
			<label>2</label>
			<div class="help2" style="display:none" align="right">
				<div>
					<div style="max-width:620px">
						<div>
							<h3>2) <?= $text->help2title ?></h3>
							<div>
								<p><?= $text->help2text1 ?></p>
							</div>
						</div>
						<div style="position:relative">
							<img src="/img/globos/companies.png">
							<p style="position:absolute;left:285px;top:285px"><?= $text->help2up ?></p>
							<p style="position:absolute;left:526px;top:285px"><?= $text->help2down ?></p>
						</div>
						<div>
							<p><?= $text->help2text2 ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="helpbox" style="top:120px; left:50px;">
			<label>3</label>
			<div class="help3" style="display:none" align="right">
				<div>
					<div style="max-width:680px">
						<div>
							<h3>3) <?= $text->help3title ?></h3>
							<div>
								<p><?= $text->help3text1 ?></p>
							</div>
						</div>
						<div style="position:relative;padding-top:8px">
							<img src="/img/globos/portfolio.png">
						</div>
						<div>
							<p><?= $text->help3text2 ?><p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
<?php
	// See https://urin.github.io/jquery.balloon.js/
	$_inline_script('jquery.balloon.min.js');
?>
function initializeHelp()
{
	debug('Setting up help balloons');
	$bvisAttr = 'balloonIsVisible';
	var setHelp = function($id) {
		var $helpCSS = {
			color: '#111',
			backgroundColor: '#fff',
			padding: '20px',
			border: '1px solid rgba(160, 160, 160, .8)',
			borderRadius: '12px',
			opacity: '1.0',
			fontSize: '14px'
		};
		$h = $($id);
		var $holder = $h.parent();
		var $contents = $h.children().html();
		var $pos = $h.attr('align');
		debug($id+': align='+$pos);
		//debug($contents);
		$holder.balloon({ position:$pos, offsetX: 20, offsety: 150, html:true, contents:$contents, css:$helpCSS, hideDuration:0 });
		$holder.attr($bvisAttr,'0');
		$holder.on("click", function() {
			$visible = $(this).attr($bvisAttr);
			debug('$visible='+$visible);
			if ($visible == '0') {
				$(this).showBalloon();
				$(this).attr($bvisAttr,'1');
			}
			else {
				$(this).hideBalloon();
				$(this).attr($bvisAttr,'0');
			}
		});
		//$h.remove();
	}
	setHelp('.help1');
	setHelp('.help2');
	setHelp('.help3');
}
</script>
