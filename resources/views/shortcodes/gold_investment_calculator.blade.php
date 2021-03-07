@php $jsondatafiltered =  str_replace('"', "'", json_encode($josndata)) @endphp
<div class="gold-investment-calculator" id="{{ $div_id }}"  data-plugin-options="{{ $jsondatafiltered }}">
	<div class="section_returnCal shotcodwraper">
	    <div class="inner-wrap shortcode-bg">
	        <!-- /.section-head -->
	        <div class="retcalc_form">
	            <form action="">
	            	<input type="hidden" name="type" value="{{ @$type }}" />
	            	<div class="form-group row">
		            	<label for="" class="col-sm-4 col-form-label">Select City / States </label>
		                <select name="p_id" class="select-style1d col-sm-8">
		                	@foreach ($cities as $p_id => $cityState)
		            			<option @if($id == $p_id) selected="selected" @endif value="{{ @$p_id }}">
		            				{{ $cityState }}
		            			</option>
		                	@endforeach
		                </select>
	            	</div>
	                @if(@$type ==1)
	                <div class="form-group row">
		                <label for="" class="col-sm-4 col-form-label">Select Carat</label>
		                <select name="carat" class="select-style1d col-sm-8">
		                	<option value="22">22 Ct</option> 
		                	<option value="24">24 Ct</option> 
		                </select>
		            </div>
	            	@endif
	            	<div class="form-group row">
	                	<label for="" class="col-sm-4 col-form-label">Investment Amount</label>
	                	<div class="col-sm-8 p-0">
	                		<input type="text" name="g_invest" id="investmentOf" placeholder="10000" class="form-control">
	                	</div>
	            	</div>
	            	<div class="form-group row">
		                <label for="" class="col-sm-4 col-form-label">Timeline </label>
		                <select name="g_timeline" class="select-style1d col-sm-8"> 
		                	<option value="1W" class="">1 Week</option>
		                    <option value="2W" class="">2 Week</option>
		                    <option value="3w" class="">3 Week</option>
		                    <option value="1M" class="">1 Month</option>
		                    <option value="3M" class="">3 Month</option>
		                    <option value="6M" class="">6 Month</option>
		                    <option value="9M" class="">9 Month</option>
		                    <option value="1Y" class="">1 Year</option>
		                </select>
		            </div>    
	                <div class="pt-4 text-center">
	                    <button type="submit" class="getGoldSilverCalculatedResult">Calculate</button>
	                </div>
	                <!-- <label for="">Period Ago</label> -->
	                <div class="get_gold_silver_return_result"></div> 
	            </form>
	        </div>
	        <!-- /.retcalc_form -->
	    </div>
	    <!-- /.inner-wrap -->
	</div>
</div>