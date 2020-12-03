<p class="text-center">Check out Profit or Loss Comparison of cities your selected</p>
<table>
	<tr>
		<th>&nbsp;</th>
		<th>Net Worth (Rs.)</th>
		<th>Profit or Loss (Rs.)</th>
		<th>Profit or Loss (%)</th>
	</tr>
	@php
		$netw = 0;
		$maxidx = 0;
		foreach ($priceRes as $key => $value) {
			if($netw < @$value['netWorth']){
				$netw = @$value['netWorth'];
				$maxidx = $key;
			}
		}
	@endphp

	@foreach($priceRes as $key => $value)
		@php
			$goldUnits = 0;
			$netWorth = 0;
			$totalProLoss = 0;
			$totalProLossPre = 0;
			$currentRate = 0;
			$gs_val = $value['timeLineRate'];
			$c_val = $value['currentRate'];
			if($gs_val){
				if($carat == 22){
					$currentRate = @$c_val->t22_1_rate;
					$timeLineRate = @$gs_val->t22_1_rate;
				}else{
					$currentRate = @$c_val->t24_1_rate;
					$timeLineRate = @$gs_val->t24_1_rate;
					 
				}
			}

			$goldUnits = ($g_invest/ $timeLineRate);
			$netWorth = @(number_format(($goldUnits * $currentRate),2));
			$totalProLoss = ($goldUnits * ($currentRate - $timeLineRate));
			$totalProLossPre=@(number_format((($totalProLoss/$g_invest)*100),2));

			$plClass='';
			$plText='';
			$plpClass='';
			$plpText='';
			$plClass ='';
			if($totalProLoss == 0){
				$plClass='black';
			}elseif($totalProLoss >= 0){
				$plClass='green';
				$plText='Profit';
			}else{
				$plClass='red';
				$plText='Loss';
			}

			if($maxidx ==$key){
				$plClass='class=geen-value';
			}else{
				$plClass='';
			}
			$keyidx = $key;
		@endphp
		<tr>
			<td {{ $plClass }}> {{ ucfirst(@$cities[$p_id[$keyidx]])}} </td>
			<td {{ @$plClass }}>
				<span >{{ @$netWorth }}</span>
			</td>
			<td {{ @$plClass }}> 
				<span>{{ @(number_format($totalProLoss,2)) }}</span>
			</td>
			<td {{ @$plClass }}> 
				<span>{{ @$totalProLossPre }}</span>
			</td>
		</tr>
	@endforeach