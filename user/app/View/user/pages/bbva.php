<div class="wraper noselect">
	<div class="world-map">
		<img src="/img/map-t.png">
	</div>

	<!-- Stock echanges -->
	<div id="exchange-list-holder">
	<?php
		foreach ($exchanges as $exchange) {
			$enable = ($exchange->id==7);
			if ($enable && ($exchange->continent_id!=0)) {
				$ename = strtoupper($exchange->name);	?>
				<div class="dashboard-company-group" company_group_id="<?=$exchange->id?>">
					<div class="dashboard-company-group-name"><?=$ename?></div>
					<div class="dashboard-underline"></div>
					<?php
						$top10 = 0;
						$names = [];
						$sorted = [];
						$market1yr = 0.0;		$panda1yr = 0.0;
						$market2yr = 0.0;		$panda2yr = 0.0;
						$market5yr = 0.0;		$panda5yr = 0.0;
						foreach ($exchange->companies as $c) {
							$m = $companies[$c];
							$names[] = $m->name;
							$sorted[] = $m;
							if ($m->top10) {
								++$top10;
								$market1yr += (($m->current_price/$m->price1yr)-1.0)*100;
								$market2yr += (($m->current_price/$m->price2yr)-1.0)*100;
								$market5yr += (($m->current_price/$m->price5yr)-1.0)*100;
								$panda1yr += ($m->profit1yr-1.0)*100;
								$panda2yr += ($m->profit2yr-1.0)*100;
								$panda5yr += ($m->profit5yr-1.0)*100;
							}
						}
						array_multisort($names,$sorted);
						if ($top10 > 0) {
							$market1yr /= $top10;		$panda1yr /= $top10;
							$market2yr /= $top10;		$panda2yr /= $top10;
							$market5yr /= $top10;		$panda5yr /= $top10;
							?>
						<?php } ?>
						<div style="padding-bottom:16px; padding-left: 10px; column-count:5">
						<?php
							foreach ($sorted as $m) {
								echo PHP_EOL;
								$info = ''.$exchange->id.'/'.$m->profit3m.'/'.$m->profit1yr.'/'.$m->profit2yr.'/'.$m->profit5yr;
								$ftb = 0;//(rand(1,10)>7;
								?>
								<div class="company-panel" company="<?=$m->id?>" info="<?=$info?>">
									<div class="pull-right">
										<?php
										if ($ftb||$m->has_alert) {
											if ($m->is_buy) {
												$badge = "panda_buy.png";
											}
											else {
												$badge = "panda_sell.png";
											}
											echo '<img src="'.$_img($badge).'" class="company-badge">';
										}
										/*<img src="<?=$_img("details.png")?>">*/
										?>
									</div>
									<div class="company-checkbox pull-left"></div>
									<div class="company-name"><?= htmlentities($m->name) ?></div>
								</div>
								<?php
							}
						?>
					</div>
				</div>
	<?php
			}
		}
	?>
	</div>

	<div id="panda-operations" style="display:none">

		<!-- Chart of panda operations for a company -->
		<div class="dashboard-group" style="padding-right: 5%">
			<?= $text->PandaOperationsFor;?><span id='chart-name'></span>
			<div class="dashboard-action-button" id="hide-chart-button"><?= $text->HideChart;?></div>
		</div>
		<div class="dashboard-underline"></div>

		<!-- Charts -->
		<style>
			.chartbox {
				margin-top: 12px;
			}
		</style>
		<div id="chart-holder1" class="chartbox"></div>
		<div id="chart-holder2" class="chartbox"></div>
		<div id="chart-holder3" class="chartbox"></div>
		<!-- Company stats go here (via ajax) -->
		<div style="margin-top: 12px; background: white;">
			<div id="company-stats"></div>
		</div>
	</div>

</div>

<?= $_script("highstock.js"); ?>

<script>
	function debug(msg) { console.log(msg);	}

	// Global vars for JavaScript
	var baseURL = '<?= $baseURL ?>';
	var user_companies = [ <?php foreach ($user_companies as $uc) { echo $uc; echo ',';	} ?> ];

<?php
	// dashboard.js
	if ($pixie->devmode) {
		echo '</script>';
		echo PHP_EOL.$_script("stats.js");
		echo PHP_EOL.$_script("dashboard_bbva.js");
		echo '<script>'.PHP_EOL;
	}
	else {
		$_inline_script('stats.js');
		$_inline_script('dashboard_bbva.js');
	}
?>

	$(function() {
		initializeDashboard();
	});
</script>
