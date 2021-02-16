
<div class="section-companylist mb-5">
	<div class="inner-wrap">
		<form action="" method="post">
			<div class="row mb-4">
			   <div class="col-md-2 col-sm-3">
			   		<input type="hidden" id="sectors_gl" value="{{$sectors_gl}}">
					<select name="high_low" id="high_low_filter" class="">
					@php
					foreach($gainerLoserFilter as $f_post){
					@endphp
							<option value="{{get_the_permalink($f_post->ID)}} " {{ ($f_post->ID == $page_id)?'selected="selected"':'' }}>
								{{$f_post->post_title}}
							</option>	
					@php
					}
					@endphp
					</select>
			   </div>
			   <div class="col-md-2 col-sm-3">
					<select name="" id="api_exchg" class="">
						<option value="NSE" {{ ($apiExchg == 'NSE')?'selected="selected"':'' }}>NSE</option>
						<option value="BSE" {{ ($apiExchg == 'BSE')?'selected="selected"':'' }}>BSE</option>
					</select>
			   </div>
			   <div class="col-md-3 col-sm-3">
					<select name="indices_index" id="indices_index_filter" class="">
					<option>All</option>
					@php
						foreach($indicesFilter as $ind_post){
						 $flt_ind_idx = get_post_meta($ind_post->ID, 'indices_code', true );
						$hide =0;
                        if(($indexCodes > 100 && $flt_ind_idx <100) || ($indexCodes < 100 && $flt_ind_idx >100)){
                              // $hide =1;
                         } 	
						@endphp
							<option data-id="{{@$flt_ind_idx}}" {{($hide)?'style="display:none;"':''}}  value="{{@$flt_ind_idx }}" {{($flt_ind_idx == @page_id)?'selected="selected"':'' }}>
								{{$ind_post->post_title}}
							</option>	
						@php
						}
					@endphp
					 
					</select>
			   </div>
			   <div class="col-md-2 col-sm-3">
			   	<input type="hidden" name=""  id="stock-period-search"  value="{{@$intra_day}}" />
			   	
					<select name="" class=""style="display: none;">
						<option value="1W" {{($intra_day =='1W')?'selected="selected"' :''}}>1 Week</option>
						<option value="1M" {{ ($intra_day =='1M')?'selected="selected"' :''}}>1 Month</option>
						<option value="3M" {{ ($intra_day =='3M')?'selected="selected"' :''}}>3 Month</option>
						<option value="6M" {{ ($intra_day =='6M')?'selected="selected"' :''}}>6 Month</option>
						<option value="52W" {{ ($intra_day =='52W')?'selected="selected"' :''}}>52 Week</option>
					</select>
			   </div>
			   <!-- col-md-2 col-sm-3 -->
			</div>
		</form>
		<div id='indices-sector-high-low-live'>
		</div> 
	</div>
</div>
