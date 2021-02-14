<ul class="tabs">
	<li class="tab-link">
		<a href="#intraday">Intraday</a>
	</li>
	<li class="tab-link">
		<a href="#delivery">Delivery</a>
	</li>
	<li  class="tab-link">
		<a href="#commodity">Commodity</a>
	</li>
	<li class="tab-link">
		<a href="#currency">Currency</a>
	</li> 
	<li class="tab-link">
		<a href="#FO">F&O</a>
	</li> 
</ul>
<div id="intraday" class="tab-content current">
	<div class="tab-inner">
		<form id="magic_cal" name="magin_submit" >
			<input type="hidden" name="prefix" value="in" />
			<input type="hidden" name="post_id" value="{{get_the_ID()}}">
			<div class="tab-row">
				<div class="tab-col required">
					<label>Search Scrip</label>
					<input id="marAutocomp" data-options="{{json_encode($intraday_search_scrip)}}" name="script_name"  placeholder="Search Scrip" type="text" class="form-control immybox immybox_witharrow" autocomplete="on">
				</div>
				<div class="tab-col required">
					<label>Available Margin</label>
					<input type="text" value="100000" name="margin" placeholder="100000" class="marAvail">
				</div>
				<div class="tab-col required">
			    	<label>Share Price </label>
					<input type="text" value="100" name="share_price" placeholder="100" class="marStockprice">
				</div>
			</div>
	    	<div style="clear: both;"></div>
		    <p style="text-align: center;">
		    	<!-- Calculate Margin Used in JQuery-->
		    	<button type="submit" class="margin-cal colormag-button calculate_margin">Calculate Margin</button>
		    </p>
		</form>
	</div>
</div>
<div id="delivery" class="tab-content">
	<div class="tab-inner">
		<form id="magic_cal_de" name="magin_submit" >
			<input type="hidden" name="prefix" value="de" />
			<input type="hidden" name="post_id" value="{{get_the_ID()}}" >
			<div class="tab-row">
				<div class="tab-col de_required">
					<label>Search Scrip</label>
					<input id="marAutocomp_de"  data-options="{{json_encode($delivery_search_scrip)}}"  name="script_name"  placeholder="Search Scrip" type="text" class="form-control immybox immybox_witharrow" autocomplete="on">
				</div>
				<div class="tab-col required">
					<label>Available Margin</label>
					<input type="text" value="100000" name="margin" placeholder="100000" class="marAvail_de">
				</div>
				<div class="tab-col required">
			    	<label>Share Price </label>
					<input type="text" value="100" name="share_price" placeholder="100" class="marStockprice_de">
				</div>
			</div>

	    	<div style="clear: both;"></div>
	    	<p style="text-align: center;">
	    		<!-- Calculate Margin Used in JQuery-->
		    	<button type="submit" class="margin-cal colormag-button calculate_margin">Calculate Margin</button>
	    	</p>
		</form>
	</div>
</div>
<div id="commodity" class="tab-content">
	<div class="tab-inner">
	<form id="magic_cal_co" name="magin_submit" >
	<input type="hidden" name="prefix" value="co" />
	<input type="hidden" name="post_id" value="{{get_the_ID()}}" >
		<div class="tab-row">
		<div class="tab-col co_required">
		<label>Search Scrip</label>
			<input id="marAutocomp_co" name="script_name" data-options="{{json_encode($commodity_search_scrip)}}"  placeholder="Search Scrip" type="text" class="form-control immybox immybox_witharrow" autocomplete="on">
		</div>
		<div class="tab-col required">
		<label>Available Margin</label>
			<input type="text" value="100000" name="margin" placeholder="100000" class="marAvail_co">
		</div>
		<div class="tab-col required">
		    <label>Share Price </label>
			<input type="text" value="100" name="share_price" placeholder="100" class="marStockprice_co">
		</div>
	</div>

    <div style="clear: both;"></div>
    <p style="text-align: center;">
    <!-- Calculate Margin Used in JQuery-->
	 	<button type="submit" class="margin-cal colormag-button calculate_margin">Calculate Margin</button>
	</form>
	</div>
</div>
<div id="currency" class="tab-content">
	<div class="tab-inner">
	<form id="magic_cal_cu" name="magin_submit" >
	<input type="hidden" name="prefix" value="cu" />
	<input type="hidden" name="post_id" value="{{ get_the_ID()}}" >
		<div class="tab-row">
		<div class="tab-col cu_required">
		<label>Search Scrip</label>
			<input id="marAutocomp_cu" name="script_name" data-options="{{json_encode($currency_search_scrip)}}" name="script_name"  placeholder="Search Scrip" type="text" class="form-control immybox immybox_witharrow" autocomplete="on">
		</div><!-- end of tab-col -->
		<div class="tab-col required">
		<label>Available Margin</label>
			<input type="text" value="100000" name="margin" placeholder="100000" class="marAvail_cu">
		</div><!-- end of tab-col -->
		<div class="tab-col required">
		    <label>Share Price </label>
			<input type="text" value="100" name="share_price" placeholder="100" class="marStockprice_cu">
		</div><!-- end of tab-col -->
	</div><!-- end of tab-row -->

    <div style="clear: both;"></div>
    <p style="text-align: center;">
    <!-- Calculate Margin Used in JQuery-->
		<button type="submit" class="margin-cal colormag-button calculate_margin">Calculate Margin</button>
	</p>
</form>
	</div>
</div>
<div id="FO" class="tab-content">
	<h4>Coming Soon</h4>
</div>