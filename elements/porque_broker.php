<section class="padding-regular sm-mb">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h4><?= txt('porque_broker') ?></h4>
				<p class="white"><?= txt('nuestra_inteligencia') ?></p>
			</div>
			<div class="col-md-3 align-self-center">
			<?php if ($language_name != "en") { ?>
				<a href="/home/porque-broker-panda" class="btn btn-primary btn-block"><?= txt('como_funciona') ?></a>
			<?php }else{ ?>
				<a href="/home/porque-broker-panda?lang=en" class="btn btn-primary btn-block"><?= txt('como_funciona') ?></a>
			<?php } ?>
				
			</div>
		</div>
	</div>
	<!-- Background image - you can choose parallax ratio and offset -->
	<div class="bg-parallax" data-stellar-ratio="0.5" data-stellar-vertical-offset="0" data-background="img/pages/glass-building-background-black.jpg"></div>
</section>