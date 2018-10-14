<div>
<?php
	function f1($n) { return number_format($n,1,',','.'); }
	function f2($n) { return number_format($n,2,',','.'); }
	function f3($n) { return number_format($n,3,',','.'); }
?>
	<style>
		#graphs {
			width: 100%;
			padding-top:10px;
			padding-bottom:30px;
		}
		#graphs span {
			display:inline-block;
			vertical-align:top;
		}
		.donuts {
			display:inline-block;
			width:280px;
		}
		.gan-graph {
			width:220px;
			height: 220px;
			padding-left:20px;
			border-left: 1px solid #ccc;
		}
		.gan-graph h5 {
			padding-bottom: 12px;
		}
		#percent-in {
			width: 80px;
			text-align:center;
			padding-right:20px;
		}
		#percent-in h5 {
			text-align:center
		}
		#numbers {
			height: 220px;
			padding-left:20px;
			border-left: 1px solid #ccc;
		}
		#daily-ops {
			padding-top: 40px;
		}
		#numbers .tgrp {
			padding-top:16px;
		}
		.tgrp .gain {
			color: #2c2;
		}
		.tgrp .loss {
			color: #c22;
		}
		
		.results-table {
			margin-top:8px;
			margin-bottom:8px;
			border-radius: 4px;
		}
		.results-table table {
			width: 100%;
		}
		.results-table th {
			font-size: 14px;
			font-weight: bold;
			padding-left: 12px;
			background-color:#eee;
		}
		.results-table td {
			font-size: 14px;
			font-weight: 500;
			padding-left: 12px;
			background-color: white;
			border: 1px dotted #eee;
		}
		.results-table tbody {
			border-bottom: 0px !important;
		}
	</style>
	<div id="graphs">
		<span class="donuts">
			<div>
				<h5>% positive positions</h5>
				<div id="winners"></div>
			</div>
			<div style="padding-top:20px">
				<h5>Profits/losses ratio</h5>
				<div id="ratio"></div>
			</div>
		</span>
		<span class="gan-graph">
			<h5>Average profit/op.: <?= f2($stats['average_gain']) ?>%</h5>
			<div id="ganancia"></div>
		</span>
		<span id="numbers">
			<div>
				<span id="percent-in">
					<h5>Time in market</h5>
					<div id="market-time"></div>
				</span>
				<span id="daily-ops">
					<h5>Ops./dia: <?= f3($stats['ops_per_day']) ?></h5>
					<h5>(una cada <?= f1($stats['op_spacing']) ?> d&iacute;as)</h5>
				</span>
			</div>
			<div class="tgrp">
				<h5 class="gain">Max runup: <?= f2($stats['runup_gain']) ?>%</h5>
				<h5 class="gain">Max consecutive profits: <?= $stats['runup'] ?></h5>
			</div>
			<div class="tgrp">
				<h5 class="loss">Max drawdown: <?= f2($stats['drawdown_loss']) ?>%</h5>
				<h5 class="loss">Max consecutive losses: <?= $stats['drawdown'] ?></h5>
			</div>
		</span>
	</div>
	<div class="results-table">
		<table class="table">
		<tr>
			<th>Performance</th><th>1 year</th><th>2 years</th><th>Total</th>
		</tr>
		<?php
			function stat_color($stats,$a,$b) {
				if ($stats[$a] > $stats[$b]) {
					return 'style="color:#2c2"';
				}
				else if ($stats[$a] < $stats[$b]) {
					return 'style="color:#c22"';
				}
				return '';
			}?>
		<tr class="even">
			<td>Panda</td>
			<td <?=stat_color($stats,'panda_1yr','market_1yr')?>><?= f1($stats['panda_1yr']) ?>%</td>
			<td <?=stat_color($stats,'panda_2yr','market_2yr')?>><?= f1($stats['panda_2yr']) ?>%</td>
			<td <?=stat_color($stats,'panda_5yr','market_5yr')?>><?= f1($stats['panda_5yr']) ?>%</td>
		</tr>
		<tr class="odd">
			<td>Market</td>
			<td <?=stat_color($stats,'market_1yr','panda_1yr')?>><?= f1($stats['market_1yr']) ?>%</td>
			<td <?=stat_color($stats,'market_2yr','panda_2yr')?>><?= f1($stats['market_2yr']) ?>%</td>
			<td <?=stat_color($stats,'market_5yr','panda_5yr')?>><?= f1($stats['market_5yr']) ?>%</td>
		</tr>
		</table>
	</div>
	<?php if (0) { ?>
		<div>
			<pre><?= json_encode($company['Company'],JSON_PRETTY_PRINT) ?></pre>
		</div>
	<?php } ?>
</div>
