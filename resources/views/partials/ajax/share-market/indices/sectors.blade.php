<div class="section-companylist mb-5">
	<div class="inner-wrap">
		<div class="section-head">
			<h2 class="">{{$section_title}}</h2>
            <p>{{$section_content}}</p>
		</div>
		<!-- section-head -->

		<form action="" method="post">
			<div class="row mb-4">
			   <div class="col-md-2 col-sm-3">
					<select name="stock_order" id="stock_order" class="">
						<option value="">All</option>
						<option value="G" <?php echo (@$stock_order =='G')?'selected="selected"':''; ?>>Gainers</option>
						<option value="L" <?php echo (@$stock_order =='L')?'selected="selected"':''; ?>>Losers</option>
					</select>
			   </div>
			   <!-- col-md-2 col-sm-3 -->
			</div>
		</form>
		<!-- row -->
	@php
	if(is_array($indicesStocks) && count($indicesStocks)){
		$idx =1;
		$pagePerItem =20;
		echo '<div id="indices-sector-g-l">';
		foreach ($indicesStocks as $key => $stock) {
			if($stock_order =='G' && @$stock->CHANGE <=0){
				continue;
			}
			if($stock_order =='L' && @$stock->CHANGE >0){
				continue;
			}
		@endphp
		 	<div class="companyList" id="stock-list-{{$idx}}" style="{{ ($idx >$pagePerItem)?'display:none;':''}}">
			   <div class="row mb20">
			      <div class="col-12">
			         <a href="{{ site_url('/') }} @$acc_companyLists[@$stock->FINCODE]" title="{{ @$stock->COMPNAME }}">
			         	<span class="cd-heading text-orange">
			         	{{@$stock->COMPNAME}}
			         	</span>
			         </a>
			      </div>
			   </div>
			   <!-- row -->
			   <div class="row companydata" data-simplebar data-simplebar-auto-hide="false">
					<div class="compData-item">
						<span class="cd-head">LTP</span>
						<span class="cd-val">
							{{@$stock->CLOSE_PRICE}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Change</span>
						<span class="cd-val {{(@$stock->CHANGE >0)?'text-green':'text-red'}}">
							{{@$stock->CHANGE}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Change% </span>
						<span class="cd-val {{ (@$stock->PER_CHANGE >0)?'text-green':'text-red'}} ">
							{{@$stock->PER_CHANGE}}
						</span>
					</div>

					<div class="compData-item">
						<span class="cd-head">Volume(Mil.)</span>
						<span class="cd-val">
							{{@$stock->VOLUME}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Turnover(Mil.)</span>
						<span class="cd-val">
							{{ @$stock->TURNOVER }}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Past 30 Day's Price</span>
						<span class="cd-val">
							{{ @$stock->MONTHPRICE }}
						</span>
					</div>

					<div class="compData-item">
						<span class="cd-head">30 Day's % chg</span>
						<span class="cd-val">
							{{ @$stock->MONTHPERCHANGE }}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">Past 365 Day's Price</span>
						<span class="cd-val {{ (@$stock->YEARPRICE >0)?'text-green':'text-red' }}">
							{{@$stock->YEARPRICE}}
						</span>
					</div>						
					<div class="compData-item">
						<span class="cd-head">365 Day's % chg</span>
						<span class="cd-val {{ (@$stock->YEARPERCHANGE >0)?'text-green':'text-red' }}">
							{{ @$stock->YEARPERCHANGE }}
						</span>
					</div>
			   </div>
			   <!-- row -->
			</div>	
		 	@php
		 	$idx++;
		}
		if($idx > $pagePerItem){
			@endphp
			<div class="alm-btn-wrap text-center">
	          <button class="alm-load-more-btn" id="loadMore" href="javascript:void(0);" data-page-per-item="{{$pagePerItem}}">Load More</button>
	        </div>
		@php
		}
		echo '<div>';
	}
	@endphp
		 
	</div>
	<!-- /.inner-wrap -->
</div>
 