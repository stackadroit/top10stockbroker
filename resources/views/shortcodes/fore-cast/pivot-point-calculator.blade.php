<div data-id="{{@$id}}" id="pivot-point-calculator" data-fincode="{{@$finCode}}" data-is-single="{{@$is_single}}">
 	
 	<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item"><a href="#mostActiveIndexVolume" role="tab" data-toggle="tab" aria-controls="mostActiveIndexVolume" class="active changeMAIEDFilter" data-expdate="{{@$ExpDate}}">Volume</a></li>
                    <li class="nav-item"><a href="#mostActiveIndexValue" role="tab" data-toggle="tab" aria-controls="mostActiveIndexValue" class="changeMAIEDFilter" data-expdate="{{@$ExpDate}}">Value</a></li>
                    <li class="nav-item"><a href="#mostActiveIndexGainers" role="tab" data-toggle="tab" aria-controls="mostActiveIndexGainers" class="changeMAIEDFilter" data-expdate="{{@$ExpDate}}">Gainers</a></li>
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="mostActiveIndexVolume" class="tab-pane fade show active">
              
        </div>
        
        <div id="mostActiveIndexValue" class="tab-pane fade">
             
        </div>
        <div id="mostActiveIndexGainers" class="tab-pane fade ">
          
        </div>
    </div>

</div>




<div class="section_returnCal section-padding">
        <div class="inner-wrap">
            <div class="retcalc_form gold-calc forms_container">
                
                <form action="">
                  <div class="_pivot_points_cal">
                      @if(!$is_single)
                        <div class="row">
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <label for="p_id1"><b>Select Company </b></label>
                                <select name="p_id1" class="select-style1d" id="pivot-point-stocks">
                                    @foreach ($compnameList as $finc => $compname)
                                        <option value="{{ @$finc }}" @if(@$finc == @$finCode) selected="selected" @endif>
                                            {{ @$compname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-5">
                                <label for="">Select Indices</label>
                                <br/>
                                <select name="p_id1" class="select-style1d" id="pivot-point-indices">
                                    @foreach ($indicesList as $finc => $indicesname)
                                        <option value="{{ @$finc }}" @if(@$finc == @$finCode) selected="selected" @endif>
                                            {{ @$indicesname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-2 col-lg-2">
                                <div class="text-right"> 
                                    <button type="buttom" id="pivot-point-refresh" data-ltp="{{@$LTP}}"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <div class="text-right"> 
                                        <button type="buttom" id="pivot-point-refresh" data-ltp="{{@$LTP}}"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
                                    </div>
                                </div>
                            </div>
                         @endif
                        <div class="row" id="pivot-points-results">
                            @foreach ($calData as $lab => $val)
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <b>{{@$lab}}</b>
                                     <p>{{@$val}}</p>
                                </div>
                             @endforeach
                             
                        </div>   
                    </div>
                    <div class="pt-4 text-center"> 
                        <button type="submit" id="calculate-pivot-points" data-ltp="{{@$LTP}}">Calculate Pivot Points</button>
                    </div>
                     
                </form>
            </div>
        </div>
    </div>