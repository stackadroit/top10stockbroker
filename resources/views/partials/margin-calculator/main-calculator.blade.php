<style type="text/css">
	.margin-output{background-color: #f9f9f9; width: 100%; margin: 10px auto;}
	.margin-output table{margin:0;}
	.margincalTable{table-layout: fixed;}
	.mar-ddata{border: 1px solid #ddd;
    padding: 10px 15px;
    border-radius: 10px;}
	ul.tabs-margin{
			margin: 0px;
			padding: 0px;
			list-style: none;
		}
		#myTable input[type=text],#myInput,#marAutocomp,#marAutocomp_co,#marAutocomp_de,#marAutocomp_cu,.marAvail_de,.marAvail_co,.marAvail_cu,.marAvail,.marStockprice,.marStockprice_de,.marStockprice_co,.marStockprice_cu{background-color: #fff !important; padding: 10px !important;}
		#myInput{width: 100%;}
		ul.tabs-margin li{
			display: inline-block;
			margin: 0 0 10px;
    		padding: 15px 32px;
    		font-weight: 600;
    		text-align: center;
    		color: #000;
    		border: 1px solid transparent;
			cursor: pointer;
			background-color: #eee;
			position: relative;
		}
		ul.tabs-margin li:before {
    content: "\f17d";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    padding-right: 0.5em;
}

		ul.tabs-margin li.current{
			background: #000;
			color: #fff;
			border-top: 2px solid orange;
		}

		.tab-content{
			display: none;
			background: #f7f7f7;
			padding: 15px;
		}

		.tab-content.current{
			display: inherit;
		}
		.margin-output tr:nth-child(odd) td {text-align: center; color: #000;}
		.margin-output tr:nth-child(even) td {font-size: 18px; font-weight: bold; text-align: center;color: #000;}
		.margin-output th{background-color: #ddd; color: #000; text-align: center;}
		.margin-cal{margin-bottom: 0 !important;}
		.leverage{    
			width: 100%;
		    border: 1px solid #212425;
		    padding: 6px 10px;
		    text-align: center;
		    font-size: 24px;
		    border-top: none;
		    font-weight: bold;
		}
		@media all and (max-width: 992px){
			ul.tabs-margin li{padding: 10px 15px;}
		}
}
.immybox.immybox_witharrow{background-image:url(/img/immybox-arrow.png);background-repeat:no-repeat;background-position:right center}
.immybox_results{position:absolute;overflow:auto;max-height:20em;background-color:white;border:1px solid #ccc;z-index:9001}
.immybox_results p.immybox_moreinfo,.immybox_results p.immybox_noresults{color:#ccc;font-style:italic;padding:0 1em;margin:0}
.immybox_results ul{list-style-type:none;margin:0;padding:0}
.immybox_results ul li{padding:0.25em 1em;-o-user-select:none;-moz-user-select:none;-khtml-user-select:none;-webkit-user-select:none;user-select:none}
.immybox_results ul li.immybox_choice{cursor:pointer}
.immybox_results ul li.immybox_choice.active{background-color:#f1f1f1}
.immybox_results ul li.immybox_choice .highlight{text-decoration:underline}
.tab-row{width: 100%;}
.tab-col{float:left; width: 33.3%}
@media all and (max-width: 550px){
.tab-col{float:left; width: 100%}	
}
</style>
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