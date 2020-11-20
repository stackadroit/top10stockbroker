<p><strong>Find Branch Office of other Brokers in {{ $terms_name }}. </strong></p>

@if( is_int($intrnalLinks) && count($intrnalLinks))
<table style="width: 87.348%; height: 5px;" width="477">
    <tbody>
    	@foreach ($intrnalLinks as $pData)
    		@if(@$pData->ID == @get_the_ID())
    			@continue
    		@endif

    		@php
    			$p_title = ucwords(str_replace('-', ' ', $pData->post_name));
    		@endphp

    		@if($Lidx%2 == 1)
                <tr>
                @php $colm =1; @endphp
            @endif

            @if($colm ==1)
                <td ><a href="{{ get_the_permalink($pData) }}" title="{{ $p_title }}">{{ $p_title }}</a></td>
            @else
                <td ><a href="{{ get_the_permalink($pData) }}" title="{{ $p_title }}">{{ $p_title }}</a></td>
            @endif

            @if(($Lidx/2) == 0)
                ({{ $Lidx }})</tr>
                @php 
                	$Lidx=1;
                	$colm=1;
                @endphp
            @endif

        @endforeach           
    </tbody>
</table>
@endif