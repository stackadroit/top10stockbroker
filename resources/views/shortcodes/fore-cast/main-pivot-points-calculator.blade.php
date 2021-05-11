<div data-id="{{@$id}}" id="main-pp-calculator">
	<div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
		<table class="table-style1 table-bordered mb-0" id="main-pp-lists">
          	 <thead>
                    <tr>
                        <th class="big-font">Stock</th>
                        <th class="big-font">Pivot Point</th>
                        <th class="big-font">Open</th>
                        <th class="big-font">High</th>
                        <th class="big-font">Low</th>
                        <th class="big-font">LTP</th>
                        <th class="big-font">Change%</th>
                        <th class="big-font">Resistance 1</th>
                        <th class="big-font">Resistance 2</th>
                        <th class="big-font">Resistance 3</th>
                        <th class="big-font">Support 1</th>
                        <th class="big-font">Support 2</th>
                        <th class="big-font">Support 3</th>
                        <th class="big-font">Sentiment</th>
                        <th class="big-font">Trade</th>
                    </tr>
          	</thead>
          	<tbody>
                 @foreach($stocks as $stock)
                 <tr>
                 	<td><a href="{{ @$stock['stock_link']}}">{{ @$stock['stock_name']}}</a></td>
                 	<td>{{@$stock['pivot_point']}}</td>
                 </tr>   
                 @endforeach
         	</tbody>
      	</table>
	</div>
</div>