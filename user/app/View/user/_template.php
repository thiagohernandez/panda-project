<?php	$pixie=$this->pixie; ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= ini_get('default_charset') ?>">
		<title><?php echo $pagetitle;?></title>
		<link rel="icon" href="<?= $_img('favicon.png') ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php /* Bootstrap css */ ?>
		<?php if ($pixie->use_CDN) { ?>
			<?= $_css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') ?>
		<?php } else { ?>
			<?= $_css('bootstrap.css') ?>
		<?php } ?>
		
		<?=
			/* Page styles */
			$_css('styles.css');
		?>

		<?php /* jQuery and bootstrap scripts */ ?>
		<?php if ($pixie->use_CDN) { ?>
			<?= $_script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js'); ?>
			<?= $_script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'); ?>
			<?= $_script('https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js'); ?>
		<?php } else { ?>
			<?= $_script('jquery.js'); ?>
			<?= $_script('bootstrap.js'); ?>
			<?= $_script('jquery.sparkline.js'); ?>
		<?php } ?>
	</head>

	<body>

		<?php
			/* Menu bar at the top */
			include('elements/menu.php');
		?>

		<div class="container">
			
			<?php /* We require JavaScript! */ ?>
			<div id="require-js" style="font-size:32px; display:block; text-align:center;">
				<script>$("#require-js").hide();</script>
				<div class="alert alert-danger center" style="margin-top:16px">
					This site requires JavaScript
				</div>
			</div>

			<?php
				/* Page contents... */
				include($subview.'.php');
			?>
		</div>
		
	</body>
</html>

