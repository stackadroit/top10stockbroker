<div class="section-companylist mb-5">
<div class="inner-wrap">
		<form action="" method="post">
			<div class="row mb-4">
			   <div class="col-md-2 col-sm-3">
			   	<input type="hidden" id="sectors_gl" value="{{$sectors_gl}}">
			   	<input type="hidden" id="apiExchg" value="{{$apiExchg}}">
					<select name="stock_order" id="gl_stock_order" class="">
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
			   <div class="col-md-3 col-sm-3">
			    
					<select name="indices_index" id="gl_indices_index_filter" class="">
					<option>All</option>
					@php
						foreach($indicesFilter as $ind_post){
						 $flt_ind_idx = get_post_meta($ind_post->ID, 'indices_code', true );
						$hide =0;
                        if(($indexCodes > 100 && $flt_ind_idx <100) || ($indexCodes < 100 && $flt_ind_idx >100)){
                              $hide =1;
                         } 	
						@endphp
							<option data-id="{{@$flt_ind_idx}}" {{($hide)?'style="display:none;"':''}}  value="{{@$flt_ind_idx }}" {{($flt_ind_idx == @$indexCodes)?'selected="selected"':''}}>
								{{$ind_post->post_title}}
							</option>	
						@php
						}
					@endphp
					</select>
			   </div>
			   <div class="col-md-2 col-sm-3">
					<select name="" class="" id="gl_stock-period-search">
						<option value="1D" {{($intra_day =='1D')?'selected="selected"' :''}}>Intra Day</option>
						<option value="1W" {{($intra_day =='1W')?'selected="selected"' :''}}>1 Week</option>
						<option value="1M" {{($intra_day =='1M')?'selected="selected"' :''}}>1 Month</option>
					</select>
			   </div>
			   <!-- col-md-2 col-sm-3 -->
			</div>
		</form>
	<div id='indices-stock-list-live'>
	</div>
	</div>
</div>
