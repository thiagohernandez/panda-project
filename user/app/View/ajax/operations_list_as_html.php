<div class="company-detail-table">
<?php
	function f1($n) { return number_format($n,1,',','.'); }
	function f2($n) { return number_format($n,2,',','.'); }
	function f3($n) { return number_format($n,3,',','.'); }
?>
<table>
 <caption>Panda profit calculation for <?php echo $companyName; ?> *</caption>
 
<?php if ( empty($operations)): ?>
	<tr class="empty">
		<td colspan="5" >There are no operations yet.</td>
	</tr>
<?php else: ?>
	<tr>
		<th>Buy date</th>
		<th>Buy price</th>
		<th>Sell date</th>
		<th>Sell price</th>
		<th>Profit/loss</th>
		<th>Panda profit total</th>
	</tr>

<?php $even = false; ?>
<?php foreach($operations as $operation): ?>

	<?php $even = !$even; ?>

	<?php $sold = isset($operation->sell_date); ?>

	<tr class="<?php echo (!$sold) ? 'buyed' : ''; ?><?php if ($even) { echo ' even'; } ?>">

      	<td class="date"><?= date('M-d-Y', strtotime($operation->buy_date)); ?></td>
      	<td><?= f2($operation->buy) ?></td>

      	<?php if ($operation->sell != 0) { ?>
					<td class="date"><?= date('M-d-Y', strtotime($operation->sell_date));?></td>
  				<td><?= f2($operation->sell) ?></td>

					<?php	$tendency = ($operation->profitability < 1.0) ? 'negative' : 'positive'; ?>
					<td class="profitability <?php echo $tendency; ?>">
						<?= f1(($operation->profitability-1.0)*100).'%'; ?>
					</td>
							
      	<?php } else { ?>

					<td class="date"><b>Open</b></td>
					<td>-</td>
					<td>-</td>

      	<?php } ?>

				<?php	
					$p = $operation->profit;
					$tendency = ($p < 1.0) ? 'negative' : 'positive';
				?>
				<td class="profitability <?php echo $tendency; ?>">
					<?php
						if ($operation->sell_date != 0) {
							echo f1(($p-1.0)*100).'%';
						}
					?>
				</td>
    </tr>
<?php endforeach; ?>
</table>
</div>
<div>&nbsp;[*] Profit calculations do not include stockbroker's fees or sales comissions.</div>

<?php endif; ?>

