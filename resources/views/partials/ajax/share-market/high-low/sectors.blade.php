
<div class="section-companylist mb-5">
	<div class="inner-wrap">
		<form action="" method="post">
			<div class="row mb30">
			   <div class="col-md-2 col-sm-3">
			   		<input type="hidden" id="sectors_gl" value="{{$sectors_gl}}">
					<select name="high_low" id="high_low_filter" class="select-style2">
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
					<select name="" id="api_exchg" class="select-style2">
						<option value="NSE" {{ ($apiExchg == 'NSE')?'selected="selected"':'' }}>NSE</option>
						<option value="BSE" {{ ($apiExchg == 'BSE')?'selected="selected"':'' }}>BSE</option>
					</select>
			   </div>
			   <div class="col-md-3 col-sm-3">
					<select name="indices_index" id="indices_index_filter" class="select-style2">
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
			   	
					<select name="" class="select-style2"style="display: none;">
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
		<!-- row -->
	@php
	if(is_array($indicesStocks) && count($indicesStocks)){
		$idx =1;
		echo "<div id='indices-sector-high-low-live'>";
		foreach ($indicesStocks as $key => $stock) {
		@endphp
		 	<div class="companyList" id="stock-list-<?php echo $idx; ?>">
			   <div class="row mb20">
			      <div class="col-12">
			         <a href="{{ site_url('/') . @$acc_companyLists[@$stock->FINCODE] }} " title="{{ @$stock->COMPNAME }}">
			         	<span class="cd-heading text-orange">
			         	{{(@$stock->COMPNAME)?@$stock->COMPNAME:'-'}}
			         	</span>
			         </a>
			      </div>
			   </div>
			   <!-- row -->
				   <div class="row companydata scrollbar-inner">
					<div class="compData-item">
						<span class="cd-head">LTP</span>
						<span class="cd-val">
							{{ (@$stock->CLOSE_PRICE)?@$stock->CLOSE_PRICE:'-'   }}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Change</span>
						<span class="cd-val {{ (@$stock->CHANGE >0)?'text-green':'text-red'}}">
							{{ (@$stock->CHANGE)?@$stock->CHANGE:'-'}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Change %</span>
						<span class="cd-val {{ (@$stock->PER_CHANGE >0)?'text-green':'text-red' }}">
							{{ (@$stock->PER_CHANGE)?@$stock->PER_CHANGE:'-'}}
						</span>
					</div>

					<div class="compData-item">
						<span class="cd-head">Volume(Mil.)</span>
						<span class="cd-val">
							{{(@$stock->VOLUME)?@$stock->VOLUME:'-'}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Turnover(Mil.)</span>
						<span class="cd-val">
							{{ (@$stock->TURNOVER)?@$stock->TURNOVER:'-'}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Past 30 Day's Price</span>
						<span class="cd-val">
							{{ (@$stock->MONTHPRICE)?@$stock->MONTHPRICE:'-'}}
						</span>
					</div>

					<div class="compData-item">
						<span class="cd-head">30 Day's % chg</span>
						<span class="cd-val">
							{{(@$stock->MONTHPERCHANGE)?@$stock->MONTHPERCHANGE:'-'}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Past 365 Day's Price</span>
						<span class="cd-val {{(@$stock->YEARPRICE >0)?'text-green':'text-red'}}">
							{{(@$stock->YEARPRICE)?@$stock->YEARPRICE:'-'}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">365 Day's % chg</span>
						<span class="cd-val {{(@$stock->YEARPERCHANGE >0)?'text-green':'text-red'}}">
							{{(@$stock->YEARPERCHANGE)?@$stock->YEARPERCHANGE:'-'}}
						</span>
					</div>
			   </div>
			   <!-- row -->
			</div>	
		 	@php
		 	$idx++;
		}
		if($totalPage >1){
			@endphp
			<div class="alm-btn-wrap" id="loadMoreWrap">
	          <button class="alm-load-more-btn" id="loadMoreHighLow" href="javascript:void(0);" data-page_no="1">Load More</button>
	        </div>
			@php
		}
		echo "</div>";
	}
	@endphp
		 
	</div>
	<!-- /.inner-wrap -->
</div>
