<table style="width: 87.7941%" height="85" width="505">
    <tbody>
        <tr>
            @if($type ==1)
	            <td style="text-align: center; width: 36.2096%;" width="219">
	            	<strong>Daily Gold Rates in {{ $city }}</strong>
	            </td>
	            <td style="text-align: center; width: 32.0492%;" width="143">
	            	<strong>22 Ct Gold Price (Rs.)</strong>
	            </td>
	            <td style="text-align: center; width: 30.2003%;" width="143">
	            	<strong>24 Ct Gold Price (Rs.)</strong>
	            </td>
            @else
	            <td style="text-align: center; width: 36.2096%;" width="219">
	            	<strong>Daily Silver Rates in {{ $city }}</strong>
	            </td>
	            <td style="text-align: center; width: 32.0492%;" width="143">
	            	<strong>Silver Price (Rs.)</strong>
	            </td>
            @endif
        </tr>
        @foreach($gs_val as $gs)
        <tr>
            <td style="text-align: center; width: 36.2096%;">
            	{{ date("d-m-Y", strtotime( $gs->date)) }}
            </td>
            <td style="text-align: center; width: 32.0492%;">
            	&#x20B9; {{ $gs->t22_10_rate }}
            </td>
            @if($type == 1)
            <td style="text-align: center; width: 30.2003%;">
            	&#x20B9; {{ $gs->t_24_10_rate }}
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>