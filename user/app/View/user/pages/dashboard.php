<div class="wraper noselect">
	<div class="world-map">
		<img src="/img/map-t.png">
	</div>
	<div class="top-panel" style="position:relative; padding-top:10px">
		<?= $this->insert('elements/help') ?>

		<div style="display:inline-block;vertical-align:top">
			<div class="exchange-table" style="width:540px">
				<?php if (0&&$fx_mode) {?>
					<div style="display:block;height:40px;"></div>
				<?php } ?>
				<table style="display:inline">
					<tr>
						<?= $this->insert('elements/exchange', array( 'name' => $text->Europe, 			'css' => 'europe', 				'continent' => 1, 'rows'=> 4)); ?>
						<?= $this->insert('elements/exchange', array( 'name' => $text->LatinAmerica,'css' => 'latinamerica', 	'continent' => 3, 'rows'=> 4)); ?>
					</tr>
					<tr>
						<?= $this->insert('elements/exchange', array( 'name' => $text->AsiaPacific, 'css' => 'asiapacific', 	'continent' => 4, 'rows'=> 3)); ?>
						<?= $this->insert('elements/exchange', array( 'name' => $text->USA, 				'css' => 'usa', 					'continent' => 2, 'rows'=> 3)); ?>
					</tr>
				</table>
			</div>
		</div>
	</div>

	<!-- Stock echanges -->
	<div id="exchange-list-holder">
	<?php
		foreach ($exchanges as $exchange) {
			$enable = false;
			switch ($user->level_id) {
				case 1:	$enable = ($user->country_id == $exchange->id);							break;
				case 2:	$enable = ($user->continent_id == $exchange->continent_id);	break;
				case 3:	$enable = true;																							break;
			}
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
							<div class="top10">
								<div>
									<div class="top10-panel" >
										<div style="display:inline-block;vertical-align:top">
											<div>
												<h5><?=$ename?> Top 10:</h5>
											</div>
											<div style="column-count:2">
												<ul>
												<?php
													foreach ($sorted as $m) {
														if ($m->top10) {?>
															<li>
																<div class="company-name"><?= htmlentities($m->name) ?></div>
															</li><?php
														}
													}
												?>
												</ul>
											</div>
										</div>
										<div class="perf-table">
											<?php if (!empty($exchange->value_id)) {?>
												<div style="padding:16px">
													<!-- table>
														<tr>
															<th class="prf_head"><?= $text->Performance ?></th>
															<th class="prf_head"><?= $text->Profit1 ?></th>
															<th class="prf_head"><?= $text->Profit2 ?></th>
															<th class="prf_head"><?= $text->Profit5 ?></th>
														</tr>
														<tr>
															<td class="prf_row"><?= $text->Market ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $market1yr) ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $market2yr) ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $market5yr) ?></td>
														</tr>
														<tr>
															<td class="prf_row"><?= $text->Panda ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $panda1yr) ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $panda2yr) ?></td>
															<td class="prf_num"><?= sprintf('%0.1f%%', $panda5yr) ?></td>
														</tr>
													</table-->
													<span id="top10chart" panda="1,4,4,7,5,9,10" market="1,2,3,2,5,8,6"></span>
												</div>
											<?php }?>
										</div>
									</div>
								</div>
							</div>
							<div><?=$text->Companies.' '.$ename?>:</div>
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

		<!-- Company stats go here (via ajax) -->
		<div id="company-stats"></div>
		<div id="chart-holder"></div>

		<!-- Details for Panda operations go here (via ajax) -->
		<div id="operations-list"></div>
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
		echo PHP_EOL.$_script("dashboard.js");
		echo '<script>'.PHP_EOL;
	}
	else {
		$_inline_script('stats.js');
		$_inline_script('dashboard.js');
	}
	// Help balloons
	$_inline_script('jquery.balloon.min.js');
?>

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
		debug($contents);
		$holder.balloon({ position:$pos, html:true, contents:$contents, css:$helpCSS, hideDuration:0 });
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
	$(function() {
		debug('Initialising dashboard');
		initializeDashboard();
		$('#top10chart').sparkline('html',{
			width:'300px',
			height:'128px',
			fillColor:false,
			chartRangeMin:0,
			lineColor: '#0f0',
			spotColor: '#0f0',
			tagValuesAttribute:'panda'
		});
		$('#top10chart').sparkline('html',{
			fillColor:false,
			chartRangeMin:0,
			composite:true,
			lineColor: '#f00',
			tagValuesAttribute:'market'
		});
		// See https://urin.github.io/jquery.balloon.js/
		debug('Setting up help balloons');
		setHelp('.help0');
		setHelp('.help1');
		setHelp('.help2');
		setHelp('.help3');
		setHelp('.help4');
		setHelp('.help5');
	});
</script>
