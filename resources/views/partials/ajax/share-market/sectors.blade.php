<div class="secion-marketgrid bg-light section-padding mb-4" id="sectors-section-wrap">
	<div class="inner-wrap px-3">
		<div class="section-head">
			<h2>{{ @$section_title }}</h2>
			<p>{{ @$section_content }}</p>
		</div>
		<!-- section-head -->

		<div class="row mb-4">
			<div class="col-md-2 col-sm-3">
				<select id="type" class="">
					<option value="Gain">Gainers</option>
					<option value="Lose">Losers</option>
				</select>
			</div>
			<div class="col-md-2 col-sm-3" style="display: none;">
				<select class="">
					<option value="NSE">NSE</option>
					<option value="BSE">BSE</option>
				</select>
			</div>
			<input type="hidden" id="exchanges" value="{{$apiExchg}}">
			<div class="col-md-2 col-sm-2">
				<select name="" class="" id="gl_indices_change">
					<option value="">ALL </option>
					@php
					foreach($indicesFilter as $ind_post){
					$flt_ind_idx = get_post_meta($ind_post->ID, 'indices_code', true );
					if(empty($flt_ind_idx)){
					$flt_ind_idx =123;
					}

					@endphp
					<option value="{{ $flt_ind_idx }}" {{ ($flt_ind_idx == @$indexCode) ? 'selected="selected"' : '' }}>
						{{ $ind_post->post_title }}
					</option>
					@php
					}
					@endphp
				</select>
			</div>
			<div class="col-md-2 col-sm-3">
				<select id="intra_day" class="">
					<option value="Daily">Intra Day</option>
					<option value="Weekly">1 Week</option>
					<option value="Monthly">1 Month</option>
				</select>
			</div>
		</div>
		<div class="marketGrids tabBox-Container" id="share-market-gainer-looser">
		</div>
		<div class="stock-btn-more-wrap">
			<a class="stock-btn-view-more" href="https://top10stockbroker.com/share-market/nse-top-gainers/" title="View More">View More
			</a>
		</div>
		<!-- marketGrids -->
	</div>
	<!-- /.inner-wrap -->
</div>