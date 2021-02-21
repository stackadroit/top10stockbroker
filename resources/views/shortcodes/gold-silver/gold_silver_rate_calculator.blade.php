<div data-id="{{@$id}}" id="{{@$div_id}}">
	<div class="section_returnCal section-padding">
	   <div class="inner-wrap">
		    <div class="retcalc_form gold-calc">
			    <form action="">
                    <input type="hidden" name="type" value="{{@$type}}" />
                    <div class="col-8">
                        <label for="">Select your City / State</label>
                    </div>
                    <div class="col-4">
                        <select name="p_id" class="select-style1d">
                           @foreach ($cities as $p_id => $cityState)
                                <option @if($id == $p_id) selected="selected" @endif value="{{ @$p_id }}">
                                    {{ $cityState }}
                                </option>
                            @endforeach
                        </select>
                    </div>
			        @if(@$type ==1)
				        <div class="col-8">
                            <label for="">Select Gold Carat </label>
                        </div>
                        <div class="col-4">
                            <select name="carat" class="select-style1d">
                                <option value="22">22 Ct</option> 
                                <option value="24">24 Ct</option> 
                            </select>
                        </div>
			        @endif
			        <div class="col-8">
                        <label for="">Unit</label>
                    </div>
                    <div class="col-4">
                        <input autocomplete="off" value="1" min="0" name="unit" type="number" step="any">
     			    </div>
                    <div class="col-8">
                        <label for="">Select Unit Type</label>
                    </div>
                    <div class="col-4">
                        <select name="unit_type" class="select-style1d"> 
                            <option value="ounce">Ounce (28.3494 Grams)</option>
                            <option selected="" value="gram">Gram</option>
                            <option value="kilo">Kilo (1000 Grams)</option>
                            <option value="tola">Tola (11.66 Grams) </option>
                            <option value="baht">Baht (15.224 Grams)</option>
                           <option value="tael">Tael (37.7994 Grams)</option>
                            <option value="troypound">Troy Pound (373.242 Grams)</option>
                           <option value="pound">Pound (453.592 Grams)</option>
                           <option value="pennyweight">Pennyweight (1.55517 Grams)</option>
                            <option value="vori">Vori (11.60 Grams)</option>
                            <option value="grain">Grain (0.0647989 Grams)</option>
                            <option value="ratti">Ratti (0.182 Grams)</option>
                            <option value="masha">Masha (0.972 Grams)</option>
                        </select>
                    </div>
			         <div class="col-8">
		                  <label for="">Time of Investment</label>
		              </div>
		          <div class="col-4">
		                        <select name="g_timeline" class="select-style1d"> 
		                            <option value="1D" class=""> Today</option>
		                            <option value="1W" class="">1 Week Ago</option>
		                            <option value="2W" class="">2 Week Ago</option>
		                            <option value="3w" class="">3 Week Ago</option>
		                            <option value="1M" class="">1 Month Ago</option>
		                            <option value="3M" class="">3 Month Ago</option>
		                            <option value="6M" class="">6 Month Ago</option>
		                            <option value="9M" class="">9 Month Ago</option>
		                            <option value="1Y" class="">1 Year Ago</option>
		                        </select>
		                    </div>
			                <div class="pt-4 text-center">  
			                     <button type="submit" class="margin-cal colormag-button calculate_margin getGoldSilverUnitCalculatedResult">Calculate  {{(@$type ==1)?'Gold':'Silver' }} Rate</button>
			                </div>

			                <div class="get_gold_silver_unit_result"></div> 
			            </form>
			        </div>
			        <!-- /.retcalc_form -->
			        
			    </div>
			    <!-- /.inner-wrap -->

			</div>
	 
		</div>