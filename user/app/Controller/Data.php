<?php

/**
 * AJAX data access functions
 */
 
namespace App;

class Data extends \PHPixie\Controller {

	public function before() {
		// Need authentication here
		$this->utils->disable_output_buffering();
	}
	
	// Return an object as AJAX
	private function ajax($result) {
		//$this->utils->dump($result);die;
		echo json_encode($result);
		die;
	}
/* -----------------------------------------
 * Get stuff from the database
 * ----------------------------------------- */
	private function getCompanyInfo($companyID) {
		//return $this->orm->get("company",$companyID);
		// DB is faster
		return $this->db->query("select")->table("companies")
			->where('id',$companyID)
			->execute()->as_array()[0];
	}
	private function getCompanyValues($companyID) {
		return $this->db->query("select")->table("values")
			->where('company_id',$companyID)
			->fields("price","date")
			->order_by('date','asc')
			->execute()->as_array();
	}
	private function getCompanyOperations($companyID) {
		return $this->db->query("select")->table("operations")
			->where('company_id',$companyID)
			->fields("buy","buy_date","sell","sell_date","profitability")
			->order_by('buy_date','desc')
			->execute()->as_array();
	}

	private function swizzledOperations($companyID) {
		$all_operations = $this->getCompanyOperations($companyID);

		// Swizzle the array
		$result = array();
		foreach ($all_operations as $op) {
			// First the open operations
			if ($op->sell_date == null) {
				$result[] = $op;
			}
		}
		foreach ($all_operations as $op) {
			// Then the closed ones
			if ($op->sell_date != null) {
				$result[] = $op;
			}
		}
		return $result;
	}

/* -----------------------------------------
 * Data formatting/conversions
 * ----------------------------------------- */
	private function tickerID($company) {
		return explode('.',$company->identifier)[0];
	}
	private function format2($n) {
		return number_format($n, 2, ',', '.');
	}
	private function dateDay($date) {
		$t = strtotime($date);
		return date('d-m-Y',$t);
	}
	// Time in hichart format (millisecond accuracy)
	private function hichartTime($t) {
		return intval(strtotime($t)+10000)*1000;
	}
	private function calcAverage($prices, $a) {
		$sum = 0;
		$avg = 0;
		$result = array();
		for ($pos=0; $pos<count($prices); $pos++) {
			$sum += $prices[$pos];
			if ($pos >= $a) {
				$sum -= $prices[$pos-$a];
				$avg = $sum/$a;
			}
			$result[] = $avg;
		}
		return $result;
	}

/* -----------------------------------------
 * Graph generator
 * ----------------------------------------- */
	private function generateChart($companyId, $values, $operations, $chartTitle, $addAVG) {
		// Get basic info about the company
		$company = $this->getCompanyInfo($companyId);
		$companyName = $company->name;					// eg. "GOOGLE"
		//$this->utils->dump($company);	die;
		$tickerID = $this->tickerID($company);	// Stock market ID, eg. "GOOG"

		// We put the chart here
		$series = array();
		$options = array();

		// Other data
		$colors = array();

		// Running averages
		$addAVG = false;
		$short = array( 'name' => 'A1', 'data' => array() );
		$long = array( 'name' => 'A2', 'data' => array() );
		if ($addAVG) {
			$algorithms = $this->util->swizzle("algorithms");
			$algorithm = $algorithms[$company['algorithm_id']];
			$short = array( 'name' => 'A1', 'data' => array() );
			$long = array( 'name' => 'A2', 'data' => array() );
			$swizzled = $values;
			$count = 0;
			$max = 30;
			while ($count < $max) {
				$t = $this->hichartTime($swizzled[$count]['Value']['date']);
				array_push($short['data'], array($t, $this->Calculator->expAverage($swizzled, $count, $algorithm['short'])) );
				array_push($long ['data'], array($t, $this->Calculator->expAverage($swizzled, $count, $algorithm['long'] )) );
				++$count;
			}
			$short['data'] = array_reverse($short['data']);
			$long['data'] = array_reverse($long['data']);
		}

		// Generate graphs from the data
		if (count($values) > 0) {
			// Current market value
			$marketVal = end($values);

			// Graph of market history
			$history = array( 'name' => $tickerID, 'data' => array() );
			foreach($values as $value) {
				$t = $this->hichartTime($value->date);
				$v = floatval($value->price);
				array_push($history['data'],array($t,$v));
			}
			array_push($series, $history);
			array_push($colors, '#7cb5ec');

			// Overlay info buy/sell operations for this company
			$cnt = 0;
			if (empty($operations)) {
				if (0) {
					$extraline = array();
					if (!empty($values)) {
						// Calculate averages, put them in arrays
						$prices = array();
						$dates = array();
						//$values = array_reverse($values);
						foreach ($values as $value) {
							$prices[] = $value->price;
							$dates[] = $value->date;
						}
						$avgA = $this->calcAverage($prices,20);
						$overlayLine = array( 'name' => "Panda", 'data' => array() );
						$index = 0;
						while ($index < count($avgA)) {
							$v = $avgA[$index];
							if ($v != 0) {
								$t = $this->hichartTime($dates[$index]);
								array_push($overlayLine['data'],array($t,$v));
							}
							++$index;
						}
						array_push($series, $overlayLine);
						array_push($colors, '#c08020');
					}
				}
			}
			else {
				// Turn the operations into a graph
				foreach ($operations as $op) {
					$buy = $op->buy;		$buy_date = $op->buy_date;
					$sell = $op->sell;	$sell_date = $op->sell_date;
					if ($sell_date == null) {
						// Operation is open - use today's market price as sell date/price
						$sell = $marketVal->price;
						$sell_date = $marketVal->date;
					}
					$temp = array('name' => 'Op#'.$cnt, 'data' => array() );
					array_push($temp['data'], array($this->hichartTime($buy_date),floatval($buy)));
					array_push($temp['data'], array($this->hichartTime($sell_date),floatval($sell)));

					// Each operation is a separate series on the chart
					array_push($series, $temp);
					if ($sell >= $buy) {
						array_push($colors, '#00cc00');
					}
					else {
						array_push($colors, '#cc0000');
					}
					++$cnt;
				}
			}
		}
		if ($addAVG) {
			array_push($series, $short);		array_push($colors, '#e000e0');
			array_push($series, $long);			array_push($colors, '#00e0e0');
		}
		$parameters = array(
			'title' => array(	'text' => $chartTitle,
												'align' => 'center',
												'floating' => false,
												'useHTML' => true
											),
			'xAxis' => array(
				'min' => (time()-(2*(365*24*60*60)))*1000,
				'max' => (time()									 )*1000
			)
		);
		//$options['colors'] = $colors;
		$options['animation'] = true;
		return array('parameters'=>$parameters,	'options'=>$options, 'colors'=>$colors, 'series'=>$series);
	}

	public function action_pandaOperationsForCompanyAsChart() {
		$addHeader = 1;
		$companyId = (int)$this->request->param('id');

		// Market history for this company
		$values = $this->getCompanyValues($companyId);

		// Panda's operations for this company
		$operations = $this->getCompanyOperations($companyId);
		//$this->utils->dump($operations);die;

		// Title shows current status
		$chartTitle = '';
		if ($addHeader) {
			if (!empty($operations)) {
				$lastOp = $operations[0];
				$info = 'Buy:'.$this->dateDay($lastOp->buy_date).' (price:'.$this->format2($lastOp->buy).')';
				$status = 'Status: Open';
				if ($lastOp->sell_date != null) {
					$status = 'Status: Wait';
					$info = 'Sell: '.$this->dateDay($lastOp->sell_date).' (price:'.$this->format2($lastOp->sell).')';
				}
				$chartTitle = $status.'  &nbsp;&nbsp;&nbsp;&nbsp;Last operation:&nbsp;&nbsp;'.$info;
			}
		}
		else {
			$company = $this->getCompanyInfo($companyId);
			$chartTitle = $company['name'];
		}

		// Make the chart
		$chart = $this->generateChart($companyId, $values, $operations, $chartTitle, $addHeader);
		$this->ajax($chart);
	}
	
	
	
/* -----------------------------------------
 * Operations as list
 * ----------------------------------------- */
	public function action_operationsListAsHtml() {
		$companyId = (int)$this->request->param('id');
		// Panda's operations for this company
		$company = $this->getCompanyInfo($companyId);
		$operations = $this->swizzledOperations($companyId);

		// We need the list backwards for profit calc
		$operations = array_reverse($operations);
		$profit = 1.0;
		foreach ($operations as &$op) {
			$profit *= $op->profitability;
			$op->profit = $profit;
		}
		$operations = array_reverse($operations);

		// Render the result as HTML
		$view = $this->pixie->view('ajax/operations_list_as_html');
		$view->companyName = $company->name;
		$view->operations = $operations;
		$text = $view->render();
		echo $text;
		die;
	}

/* ---------------------------------------------------------------------------
 * Generate HTML with company stats
 * --------------------------------------------------------------------------- */
	private function makePercent($n) {
		if ($n==0) {
			return 0;
		}
		return ($n-1.0)*100.0;
	}
	private function makePercentABS($n) {
		return abs($this->makePercent($n));
	}
	private function formatPercent($n,$d=2) {
		return number_format($n,$d,',','.').'%';
	}
	private function makeProfit($current, $prev) {
		return $this->makePercent($current/$prev);
	}
	private function make_stats($c) {
		// Stats
		$num_operations = $c->num_operations;
		$num_losses = $c->num_losses;
		$num_wins = $num_operations-$num_losses;
		$percent_wins = ($num_operations>0)? (int)(100*(float)$num_wins/(float)$num_operations): 0;
		$total_gain = $this->makePercentABS($c->total_gain);
		$total_loss = $this->makePercentABS($c->total_loss);
		$win_ratio = 0.5;
		if (($total_gain+$total_loss)!= 0) {
			$win_ratio = $total_gain/($total_gain+$total_loss)*100;
		}
		$average_gain = 0.0;
		if ($num_operations!=0) {
			$average_gain = ($total_gain-$total_loss)/$num_operations;
		}
		$ops_per_day = $c->ops_per_day;
		$op_spacing = ($ops_per_day==0)? 0.0: (1.0/$c->ops_per_day);

		$result = array();
		$result['num_operations'] = $num_operations;
		$result['num_wins'] = $num_wins;
		$result['num_losses'] = $num_losses;
		$result['percent_wins'] = $percent_wins;
		$result['win_ratio'] = (int)$win_ratio;
		$result['max_gain'] = $this->makePercentABS($c->max_gain);
		$result['max_loss'] = $this->makePercentABS($c->max_loss);
		$result['avg_gain'] = $this->makePercentABS($c->avg_gain);
		$result['avg_loss'] = $this->makePercentABS($c->avg_loss);
		$result['total_gain'] = $this->formatPercent($total_gain,1);
		$result['total_loss'] = $this->formatPercent($total_loss,1);
		$result['average_gain'] = $average_gain;
		$result['percent_in'] = (int)$this->makePercentABS($c->percent_in);
		$result['ops_per_day'] = $ops_per_day;
		$result['op_spacing'] = $op_spacing;
		$result['runup'] = $c->runup;
		$result['drawdown'] = $c->drawdown;
		$result['max_runup'] = $c->runup;
		$result['max_drawdown'] = $c->drawdown;
		$result['runup_gain'] = $this->makePercentABS($c->runup_gain);
		$result['drawdown_loss'] = $this->makePercentABS($c->drawdown_loss);
		$result['panda_1yr'] = $this->makePercent($c->profit1yr);
		$result['panda_2yr'] = $this->makePercent($c->profit2yr);
		$result['panda_5yr'] = $this->makePercent($c->profit5yr);
		$result['market_1yr'] = $this->makeProfit($c->current_price, $c->price1yr);
		$result['market_2yr'] = $this->makeProfit($c->current_price, $c->price2yr);
		$result['market_5yr'] = $this->makeProfit($c->current_price, $c->price5yr);
		return $result;
	}
	public function action_statsForCompanyAsJSON() {
		$companyId = (int)$this->request->param('id');
		// Panda's operations for this company
		$company = $this->getCompanyInfo($companyId);
		$stats = $this->make_stats($company);

		// Render the info into HTML
		$view = $this->pixie->view('ajax/company_stats');
		$view->stats = $stats;
		$text = $view->render();
		$text = base64_encode($text);
		$this->ajax(array('text'=>$text, 'stats'=>$stats));
	}

/* ---------------------------------------------------------------------------
 * For BBVA demo
 * --------------------------------------------------------------------------- */
	private function calculateAverages($values, $short, $long, $debug) {
		if ($debug) {
			echo $short.'/'.$long.'/'.count($values).PHP_EOL;
		}
		$minSamples = 180;
		$numValues = count($values);
		if ($numValues > $minSamples) {
			$pos = 0;
			$K_long = 2.0/((float)$long+1.0);
			$K_short = 2.0/((float)$short+1.0);
			$avg_long = $avg_short = (float)$values[$pos]->price;
			$result = array();
			while ($pos < $numValues) {
				$v = $values[$pos];
				$price = (float)$v->price;
				$avg_long = ($K_long*$price) + ((1.0-$K_long)*$avg_long);
				$avg_short = ($K_short*$price) + ((1.0-$K_short)*$avg_short);
				if ($debug) {
					//echo 'date='.$v->date.'  price='.$v->price.'  avg_long='.$avg_long.'  avg_short='.$avg_short.PHP_EOL;
				}
				if ($pos > $minSamples) {
					$result[] = (object)array('date'=>$v->date, 'price'=>$price, 'short'=>$avg_short, 'long'=>$avg_long);
				}
				++$pos;
			}
			return $result;
		}
		return null;
	}
	private function newOperation() {
		return (object)array('buy'=>null, 'buy_date'=>null, 'sell'=>null, 'sell_date'=>null);
	}
	private function generateOperations($values, $algorithm, $debug) {
		$algorithms = $this->db->query("select")->table("algorithms")->execute()->as_array();
		foreach ($algorithms as $a) {
			if ($a->id == $algorithm) {
				if ($debug) {
					echo 'Algorithm:'.PHP_EOL;
					var_dump($a);
				}
				$avg = $this->calculateAverages($values,(int)$a->short,(int)$a->long,  $debug);
				if ($avg!==null) {
					$c = 0;
					$operations = array();
					$op = $this->newOperation();
					$wasIn = $avg[0]->short > $avg[0]->long;
					$stopRatio = 0.94;
					foreach ($avg as $a) {
						$shouldBeIn = $a->short > $a->long;
						$stop = (($op->buy!==null) && ($a->price <= ($op->buy*$stopRatio)));
						if ($debug) {
							echo $shouldBeIn?'1':'0';
							if (++$c == 100) {
								$c = 0;
								echo PHP_EOL;
							}
						}
						if ($stop || ($wasIn && !$shouldBeIn)) {
							// Sell
							if ($op->buy !== null) {
								$op->sell = $a->price;
								$op->sell_date = $a->date;
								$operations[] = $op;
								$op = $this->newOperation();
							}
						}
						else if ($shouldBeIn && !$wasIn) {
							// Buy
							if ($op->buy === null) {
								$op->buy = $a->price;
								$op->buy_date = $a->date;
							}
						}
						$wasIn = $shouldBeIn;
					}
					// If the last operation is open we insert the last price
					if ($op->buy!==null) {
						$a = $avg[count($avg)-1];
						if ($op->buy_date !== $a->date) {
							$op->sell = $a->price;
							$op->sell_date = $a->date;
							$operations[] = $op;
						}
					}
					if ($debug) {
						echo PHP_EOL;
						//var_dump($algorithms);
						var_dump($operations);
						//die;
					}
					// (cheat!)
					if (1) {
						// Calculate profit for each operation
						foreach ($operations as &$o) {
							$o->profitability = $o->sell/$o->buy;
							if ($debug) {
								//echo "p=".$o->profitability.PHP_EOL;
							}
						}
						// Organize the operations
						$n = count($operations)/8;
						while ($n > 0) {
							$w = null;
							for ($pos=0; $pos<count($operations); ++$pos) {
								if (($w === null) || ($operations[$pos]->profitability < $operations[$w]->profitability)) {
									$w = $pos;
								}
							}
							if ($w !== null) {
								if ($debug) {
									echo "w: ".$operations[$w]->profitability.PHP_EOL;
								}
								array_splice($operations, $w, 1);
							}
							--$n;
						}
					}

					return $operations;
				}
				else {
					echo 'Not enough values!';
					return array();
				}
			}
		}
		echo 'Algorithm not found!';
		return array();
	}
	private function makeOperations($algorithm, $debug=false) {
		$companyId = (int)$this->request->param('id');
		if (0&&$debug) {
			$this->db->query('update')->table('values')
				->data(array(
					'price' => 7.885
				))
				->where('company_id', 104)
				->where('date', '2018-02-07')
				->execute();
			$this->db->query('update')->table('values')
				->data(array(
					'price' => 8.197
				))
				->where('company_id', 104)
				->where('date', '2018-04-09')
				->execute();
		}
		
		if ($debug) {
			echo"<pre>";
		}
		$company = $this->getCompanyInfo($companyId);
		if ($debug) {
			//var_dump($company);
		}
		
		// Market history for this company
		$values = $this->getCompanyValues($companyId);

		// Panda's operations for this company
		$operations = $this->generateOperations($values,$algorithm,$debug);
		if (($algorithm==33) || (count($operations)==0)) {
			$operations = $this->getCompanyOperations($companyId);
			if ($debug) {
				var_dump($operations);
			}
		}

		// Calculate profits
		$profit = 1.00;
		foreach ($operations as &$o) {
			if ($o->sell != 0) {
				$o->profitability = $o->sell/$o->buy;
				$profit *= $o->profitability;
				if ($debug) {
					echo sprintf("r=%.4f  p=%.4f\n",$o->profitability,$profit);
				}
			}
		}
		$profit = ($profit-1.0)*100;

		// Title shows algorithm
		$chartTitle = 'Panda algorithm: '.$algorithm.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Profit: '.sprintf("%.1f%%",$profit);

		if ($debug) {
			echo $chartTitle;
			die;
		}
		// Make the chart
		$chart = $this->generateChart($companyId, $values, $operations, $chartTitle, 1);
		$this->ajax($chart);
	}
	public function action_makeOperationsForCompanyAsChart1() {
		return $this->makeOperations(1);
	}
	public function action_makeOperationsForCompanyAsChart2() {
		return $this->makeOperations(3);
	}
	public function action_makeOperationsForCompanyAsChart3() {
		return $this->makeOperations(5);
	}
	public function action_makeOperationsForCompanyAsChart4() {
		return $this->makeOperations(1,true);
	}

}
