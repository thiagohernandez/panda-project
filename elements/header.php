<nav class="navbar navbar-expand-lg">
	<?php if ($language_name != "en") { ?>
		<a class="navbar-brand" href="/home/"><span class="sr-only"><?= txt('navbar_brand') ?></span></a>
	<?php }else{ ?>
		<a class="navbar-brand" href="/home/?lang=en"><span class="sr-only"><?= txt('navbar_brand') ?></span></a>
	<?php } ?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon">
	  </span>
	</button>

	<div class="collapse navbar-collapse" id="navbarsExampleDefault">
	  <ul class="navbar-nav mr-auto">
		<li class="nav-item" id="home_header">
			<?php if ($language_name != "en") { ?>
				<a  class="nav-link" href="/home/"><?= txt('home') ?> <span class="sr-only">(current)</span></a>
			<?php }else{ ?>
				<a  class="nav-link" href="/home/?lang=en"><?= txt('home') ?> <span class="sr-only">(current)</span></a>
			<?php } ?>
		</li>
		<li class="nav-item" id="porque_header">
			<?php if ($language_name != "en") { ?>
				<a class="nav-link" href="/home/porque-broker-panda"><?= txt('porque') ?></a>
			<?php }else{ ?>
				<a class="nav-link" href="/home/porque-broker-panda?lang=en"><?= txt('porque') ?></a>
			<?php } ?>
        </li>
		<li class="nav-item" id="porque_header">
			<?php if ($language_name != "en") { ?>
				<a class="nav-link" href="/home/panda-academy"><?= txt('pandaacademy') ?></a>
			<?php }else{ ?>
				<a class="nav-link" href="/home/panda-academy?lang=en"><?= txt('pandaacademy') ?></a>
			<?php } ?>
		</li>
		<li class="nav-item" id="contacto_header">
			<?php if ($language_name != "en") { ?>
				<a class="nav-link" href="/home/contacto"><?= txt('contacto') ?></a>
			<?php }else{ ?>
				<a class="nav-link" href="/home/contacto?lang=en"><?= txt('contacto') ?></a>
			<?php } ?>
		</li>
	  </ul>
	  <div class="form-inline my-2 my-lg-0">
		<?php if ($language_name != "en") { ?>
			<a class="btn btn-primary my-2 my-sm-0" href="crear-cuenta"><?= txt('create_account') ?></a>
		<?php }else{ ?>
			<a class="btn btn-primary my-2 my-sm-0" href="crear-cuenta?lang=en"><?= txt('create_account') ?></a>
		<?php } ?>
		<?php if ($language_name != "en") { ?>
			<a class="btn btn-outline my-2 my-sm-0" href="login"><?= txt('login') ?></a>
		<?php }else{ ?>
			<a class="btn btn-outline my-2 my-sm-0" href="login?lang=en"><?= txt('login') ?></a>
		<?php } ?>
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item dropdown">

			<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">ES</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown01">
				<?php if ($language_name != "en") { ?>
					<a class="dropdown-item" href="/home/<?= $page_to_serve ?>?lang=en"><?= txt('english') ?></a>
				<?php } ?>
				<?php if ($language_name != "es") { ?>
					<a class="dropdown-item active" href="/home/<?= $page_to_serve ?>"><?= txt('espanol') ?></a>
				<?php } ?>
			</div>
		  </li>
		</ul>
	  </div>
	</div>
</nav>