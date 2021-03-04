<!-- <div class="goldsilverpricetoday" id="{{ $div_id }}"> -->
	<table>
		<tbody>
		@if($type == 1)
			<tr style="height: 30px;" class="font-weight-bold">
				<td>{{ $title }}</td>
				<td>1 Gram</td>
				<td>10 Gram</td>
				<td>100 Gram</td>
			</tr>
		@else
			<tr style="height: 30px;" class="font-weight-bold">
				<td>{{ $title }}</td>
				<td>10 Gram</td>
				<td>100 Gram</td>
				<td>1 KG</td>
			</tr>
		@endif
			<tr style="height: 23px;">
				<td>Today Price (Rs.)</td>
				<td>{{ $today_rate1 }}</td>
				<td>{{ $today_rate10 }}</td>
				<td>{{ $today_rate100 }}</td>
			</tr>
			<tr style="height: 23px;">
				<td>Yesterday Price (Rs.)</td>
				<td>{{ $yesterday_rate1 }}</td>
				<td>{{ $yesterday_rate10 }}</td>
				<td>{{ $yesterday_rate100 }}</td>
			</tr>
			<tr style="height: 23px;">
				<td>Change (Rs.)</td>
				<td><span class="{{ @$diff_class1 }}">{{ $diff1 }}</span></td>
				<td><span class="{{ @$diff_class10 }}">{{ $diff1 }}</span></td>
				<td><span class="{{ @$diff_class100 }}">{{ $diff100 }}</span></td>
 
			</tr>
			<tr style="height: 23px;">
				<td>Change (%)</td>
				<td><span class="{{ @$diff_class1 }}">{{round($diff_per1,2)}}%</span></td>
				<td><span class="{{ @$diff_class10 }}">{{round($diff_per10,2)}}%</span></td>
				<td><span class="{{ @$diff_class100 }}">{{round($diff_per100,2)}}%</span></td>
 
			</tr>
			<tr style="height: 23px;">
				<td>Performance</td>
				<td>{{ $per1 }}</td>
				<td>{{ $per10 }}</td>
				<td>{{ $per100 }}</td>
			</tr>
		</tbody>
	</table>
<!-- </div> -->