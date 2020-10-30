<table class="text-center">
    <tbody>
        <tr class="font-weight-bold">
            @if($type == 1)
	            <td>Daily Gold Rates in {{ $city }}</td>
	            <td>22 Ct Gold Price (Rs.)</td>
	            <td>24 Ct Gold Price (Rs.)</td>
            @else
	            <td>Daily Silver Rates in {{ $city }}</td>
	            <td>Silver Price (Rs.)</td>
            @endif
        </tr>
        @foreach($gs_val as $key => $gs)
        @if($loop->count > 15) 
            @break
        @endif
        @php
            $pastDayData = @$gs_val[$key +1 ];
            $secColChange = @$gs->t22_10_rate - @$pastDayData->t22_10_rate;
            
            if($secColChange > 0){
                $sdiff_class = 'geen-value';
                $sarrowclass="fa-angle-up";
            }elseif($secColChange < 0){ 
                $sdiff_class = 'red-value';
                $sarrowclass="fa-angle-down";
            }else{
                $sdiff_class = 'black-value';
                $sarrowclass="fa-angle-right";
            }

            if($type == 1){
                $thrColChange = @$gs->t_24_10_rate - @$pastDayData->t_24_10_rate;
                if($thrColChange > 0){
                    $tdiff_class = 'geen-value';
                    $tarrowclass="fa-angle-up";
                }elseif($thrColChange < 0){ 
                    $tdiff_class = 'red-value';
                    $tarrowclass="fa-angle-down";
                }else{
                    $tdiff_class = 'black-value';
                    $tarrowclass="fa-angle-right";
                }
            }
        @endphp
        <tr>
            <td>{{ date("d-m-Y", strtotime( $gs->date)) }}</td>
            <td > 
                &#8377; {{ $gs->t22_10_rate }} 
                ( <span class="{{ $sdiff_class }}"> {{ $secColChange }}<i class="fas arrow-style {{ $sarrowclass }} "></i></span> ) 
            </td>
            @if($type == 1)
            <td > 
                &#8377; {{ $gs->t_24_10_rate }} 
                ( <span class="{{ $tdiff_class }}"> {{ $thrColChange }} <i class="fas arrow-style {{ $tarrowclass }} "></i></span> ) 
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>