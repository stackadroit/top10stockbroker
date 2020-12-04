<div class="secion-marketgrid bg-light section-padding" id="sectors-section-wrap">
	<div class="inner-wrap">
		<div class="section-head">
			<h2>{{ @$section_title }}</h2>
			<p>{{ @$section_content }}</p>
		</div>
		<!-- section-head -->

		<div class="row mb30">
		   <div class="col-md-2 col-sm-3">
				<select id="type" class="select-style2">
					<option value="Gain">Gainers</option>
					<option value="Lose">Losers</option>
				</select>
		   </div>
		   <div class="col-md-2 col-sm-3"  style="display: none;"> 
				<select class="select-style2">
					<option value="NSE">NSE</option>
					<option value="BSE">BSE</option>
				</select>
		   </div>
		   <input type="hidden"  id="exchanges" value="{{$apiExchg}}">
		   <div class="col-md-2 col-sm-2">
				<select name="" class="select-style2" id="gl_indices_change">
				   <option value="">ALL </option>
				    @php
                  	foreach($indicesFilter as $ind_post){
                       	$flt_ind_idx = get_post_meta($ind_post->ID, 'indices_code', true ); 
                        if(empty($flt_ind_idx)){
                           	$flt_ind_idx =123;
                        }
                                
                    @endphp
                    <option value="{{ $flt_ind_idx }}"
                                    {{ ($flt_ind_idx == @$indexCode) ? 'selected="selected"' : '' }}>
                                       {{ $ind_post->post_title }}
                    </option>   
                    @php
                   }
                 @endphp
				</select>
		   </div>
		   <div class="col-md-2 col-sm-3">
				<select id="intra_day" class="select-style2">
					<option value="Daily">Intra Day</option>
					<option value="Weekly">1 Week</option>
					<option value="Monthly">1 Month</option>
				</select>
		   </div>
		</div>
		<div class="marketGrids tabBox-Container" id="share-market-gainer-looser">
			@php
			if($GLResponse && count($GLResponse)){
			    	$idx =6;
			    	foreach ($GLResponse as $key => $rowObj) {
			@endphp
			    		<div class="marketGridElement">
					      <div class="marketGridElementTop text-center vC marketGrid-{{ ($idx ==6) ? 1: $idx }}  color-green">
					         <div class="centerText">
					            <a href="<?php echo site_url('/') .@$acc_companyLists[@$rowObj->FINCODE] ?>" title="<?php echo $rowObj->S_NAME ?>">
					            	<span class="companyName">
					            	{{ $rowObj->S_NAME }}</span>
					            </a>
					            <br>
					            <span class="ltpVal">{{number_format($rowObj->OPEN_PRICE ,2)}}</span>
					            <br>
					            <span class="changeVal">{{ number_format($rowObj->NETCHG,2) }} </span>
					            <span class="changePercentVal">( {{ number_format($rowObj->PERCHG,2) }} %)</span>
					         </div>
					         <!-- centerText -->
					      </div>
					      <!-- marketGridElementTop -->
					   	</div>
					   	<!-- marketGridElement -->
			    		@php
			    		$idx = ($idx >= 10)?10:($idx+1);
			    	}
			    }
			@endphp
		   <div class="clearfix"></div>
		</div>
		 
		<div class="stock-btn-more-wrap">
          <a class="stock-btn-view-more" href="#" href="javascript:void(0);">View More
          </a>
        </div>
		<!-- marketGrids -->
	</div>
	<!-- /.inner-wrap -->
    </div>
 