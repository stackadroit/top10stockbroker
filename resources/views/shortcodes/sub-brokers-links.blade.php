<p><strong>Find Best Sub Brokers in Nearby Cities</strong></p>
	<table style="width: 87.348%; height: 5px;" width="477">
    	<tbody>
    		@php
    		$Lidx=1;
	        $colm=1;
	        
	        foreach ($posts_array as $pData) {
	        $p_title =ucwords(str_replace('-', ' ', $pData->post_name));
	                 if($Lidx%3 ==1){
	                    echo '<tr>';
	                    $colm =1;
	                 }
	                 if($colm ==1){
	                    echo '<td ><a href="'.get_the_permalink($pData).'" title="'.$p_title.'">'.$p_title.'</a></td>';
	                 }else{
	                    echo '<td ><a href="'.get_the_permalink($pData).'" title="'.$p_title.'">'.$p_title.'</a></td>';
	                 }
	                 
	                 if(($Lidx/3) ==0){
	                    echo ($Lidx).'</tr>';
	                    $Lidx=1;
	                    $colm=1;
	                 }
	                 $Lidx++;
	                 $colm++;
	            }
    		@endphp
	    </tbody>
	</table>