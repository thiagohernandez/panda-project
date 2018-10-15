<td class="dashboard-group" style="vertical-align:top;">
	<?= $name ?>
	<div class="dashboard-underline"></div>
	<table><tr>
	<?php
		$row = 1;
		foreach ($exchanges as $exchange) {
			if ($exchange->continent_id == $continent) {
				$enable = false;
				switch ($user->level_id) {
					case 1:		$enable = ($user->country_id == $exchange->id);	break;
					case 2:		$enable = ($user->continent_id == $continent);	break;
					case 3:		$enable = true;
				}
				if ($row == 1) {
					echo '<td style="vertical-align:top">';
				}
				if ($enable) {
					echo PHP_EOL.'<div class="exchange-button exchange-button-enabled '.$css.' hover-raise" exch="'.$exchange->id.'">';
						echo '<div class="country '.strtolower($exchange->country).'"></div>';
						echo '<div class="exchange-name">'.strtoupper(htmlentities($exchange->name)).'</div>';
						if (1||$exchange->has_alert) {
							echo '<img src="'.$_img("panda_op.png").'" class="exchange-panda">';
						}
					echo '</div>';
				}
				else {
					echo PHP_EOL.'<div class="exchange-button exchange-button-disabled '.$css.'" exch="'.$exchange->id.'">';
						echo '<div class="country '.strtolower($exchange->country).'"></div>';
						echo '<div class="exchange-name">'.strtoupper(htmlentities($exchange->name)).'</div>';
					echo '</div>';
				}
				if (++$row > $rows) {
					echo '</td>';
					$row = 1;
				}
			}
		}
		if ($row != 1) { echo '</td>';	}
	?>
	</tr></table>
</td>

