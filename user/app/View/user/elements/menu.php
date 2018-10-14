<div class="logo-holder">
	<div class="logo logo-back">
		<img src="<?= $_img('logo.png') ?>" alt="Broker Panda">
	</div>
	<div class="logo logo-front">
		<img src="<?= $_img('logo.png') ?>" alt="Broker Panda">
	</div>
</div>
<style>
.test-buttons {
	display: inline;
	position: relative;
	top: 8px;
	left: 300px;
}
.test-buttons img {
	width:50px;
}
</style>
<div class="header-container">
	<header class="header">
		<div class="test-buttons">
			<a href="<?= $_link('/pages/dashboard/1') ?>">
				<img src="<?= $_img('badge_peq.png') ?>">
			</a>
			<a href="<?= $_link('/pages/dashboard/2') ?>">
				<img src="<?= $_img('badge_gran.png') ?>">
			</a>
			<a href="<?= $_link('/pages/dashboard/3') ?>">
				<img src="<?= $_img('badge_30.png') ?>">
			</a>
		</div>
		<nav id="defaultnav">
			<ul class="menu">
				<?php
				$menu_mode = 'dash';
				if ($menu_mode != 'dash') {?>
					<li class="menu-portfolio">
						<a class="menu<?php if ($menu_mode=='dash') echo' active';?>" href="<?= $_link('/user')?>"><?= $text->Portfolio ?></a>
					</li>
				<?php } ?>
				<li class="menu-profile">
					<a class="menu<?php if ($menu_mode=='profile') echo' active';?>" href="<?= $_link('/user/profile')?>"><?= $text->Profile ?></a>
				</li>
				<li class="menu-logout">
					<a class="menu" href="<?= $_link('/login/logout')?>"><?= $text->Logout?></a>
				</li>

				<li class="thinborder">
				<a href="/users/download"><img src="<?= $_img('panda_app_icon.png')?>"></a>
				</li>
				
				<!-- Always present ... language selection -->
				<li class="thinborder">
				<?php if ($text->isEnglish()) { ?>
				<a href="/user/setlanguage/es/<?php echo $menu_mode;?>"><img src="<?= $_img('flag-es.png')?>"></a>
				<?php } else { ?>
				<a href="/user/setlanguage/en/<?php echo $menu_mode;?>"><img src="<?= $_img('flag-en.png')?>"></a>
				<?php } ?>
				</li>

				<!-- Always present ... learn/contact -->
				<li class="thinborder">
					<table>
						<tr>
							<td><a href="/users/learn" style="padding:1px 6px"><?php echo $text->Learn; ?></a></td>
						</tr>
						<tr>
							<td><a href="/users/contact" style="padding:1px 6px"><?php echo $text->Contact; ?></a></td>
						</tr>
					</table>
				</li>
			</ul>
		</nav>
	</header>
</div>
