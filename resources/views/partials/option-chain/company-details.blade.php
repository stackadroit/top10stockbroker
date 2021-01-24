@if(@$company_details)
  @if(@$ajaxLoad)
  @else
    <div class="section-companyprice bg-light section-padding mb-5"  id="company-stock-live">
  @endif
    
        <div class="inner-wrap px-3">
            <div class="row align-items-center mb-4">
                <div class="col-md-2 full-box order-md-last">
                    <div class="select-theme-stb">          
                        <select name="" id="ddlCompanySymble" class="">
                            @php 
                                foreach ($get_symble_list as $lprow) {
                                  $smName=get_post_meta($lprow->ID,'symbol',true);
                                  if($smName){
                                  @endphp
                                    @if(@$is_template)
                                      <option data-symble="{{$lprow->symbol}}" {{($smName==$symbol)?'selected="selected"':'' }} value="{{$smName}}" >
                                          {{$smName}}
                                          </option>
                                    @else
                                      <option data-symble="{{$lprow->symbol}}" {{($smName==$symbol)?'selected="selected"':'' }} value="{{ get_the_permalink($lprow->ID) }}" >
                                          {{$smName}}
                                          </option>
                                    @endif
                                  @php
                                  }
                                }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-md-4"> 
                    <input type="hidden" id="companyInstName" name="" value="{{$inst_name}}" />     
                    <h2 class="names" id="company-name" style="margin: 0px; padding:0;" title="{{$comp_name}}">{{@$comp_name}}</h2>
                    <div class="index"> 
                        <span class="group"> 
                            <span>SP : </span><span id="set1-value" class="index-val border-right">{{@$company_details['STRIKEPRICE']}}</span>
                        </span> 
                        <span class="group"> 
                            <span>OT : </span><span id="set2-value" class="index-val border-right">
                              @php
                              if(@$company_details['OPTTYPE'] =='PE'){
                                echo 'PUT';
                              }
                              if(@$company_details['OPTTYPE'] =='CE'){
                                echo 'CALL';
                              }
                              @endphp
                            </span>
                        </span> 
                        <span class="group"> 
                            <span>ED : </span><span id="set3-value"  class="index-val" title="Banks">{{date('d M Y', strtotime($company_details['EXPDATE']))}}</span>
                        </span>
                    </div>    
                </div>
                <div class="col-md-6 valuesDiv"> 
                  @php
                    if(@$company_details['FaOdiff'] >= 0 ){
                      $arrowClass ="fa-arrow-up color-green";
                      $lavelClass ="color-green";
                    }else{
                      $arrowClass ="fa-arrow-down color-red";
                      $lavelClass ="color-red";
                    }
                    @endphp       
                    <div class="value">              
                        <span class="fas sm-icon-box {{$arrowClass}}" id="currentStockRateArrow"></span>              
                        <span class="" id="currentStockRate">{{@number_format(@$company_details['LTP'],2)}}</span>              
                    </div>          
                    <div class="change">Change: <span class="{{$lavelClass}}" id="currentStockChange">{{@number_format(@$company_details['FaOdiff'],2) }} ({{ @number_format(@$company_details['FaOchange'],2) }}%)</span></div>      
                </div>
            </div>
              <div class="row option-search mb-4 align-items-end"> 
                 <div class="col-12 col-md-3 ">
                    <div class="search-wrap">
                      <label>Expiry Date</label>
                      <select id="ExpiryDate" class="">
                            @php foreach($expiry_date as $lprow){ @endphp
                                <option {{($exp_date ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                            @php } @endphp
                        </select>
                    </div>
                 </div>
                 <div class="col-6 col-md-3">
                    <div class="search-wrap">
                         <label> Option Type</label>
                       <select name="" class="" id="OptionType">
                          
                            @php foreach($option_type as $lprow){
                              $ot ='';
                              if(@$lprow =='PE'){
                               $ot ='PUT';
                              }
                              if(@$lprow =='CE'){
                                $ot = 'CALL';
                              }
                             @endphp
                                <option {{($opt_type ==$lprow)?'selected="selected"':'' }} value="{{$lprow}}">{{$ot}}</option>
                            @php } @endphp
                        </select>
                    </div>
                 </div>
                 <div class="col-6 col-md-3">
                    <div class="search-wrap">
                      <label>Strike Price</label>
                        <select id="StrikePrice" class="">
                        @php foreach($strike_price as $lprow){ @endphp
                            <option {{($stk_price ==$lprow->StrikePrice)?'selected="selected"':''}} value="{{$lprow->StrikePrice}}">{{$lprow->StrikePrice}}</option>
                        @php } @endphp
                    </select>
                    </div>
                 </div>
                  <div class="col-12 col-md-2">
                    <button class="search-icons" style="padding: 7px 15px;" type="submit" id="filter_derivative_details">Search Options</button>
                  </div>
             </div>
            <div class="row marketDetails bt">  
                
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">Strike Price</span><br>                  
                            <span class="value" id="strick_price">{{@number_format(@$company_details['STRIKEPRICE'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Price</span><br>                  
                            <span class="value" id="open_price">{{@number_format(@$company_details['OPENPRICE'],2)}}</span>              
                        </div>  
                    </div>
                </div>
                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">High Price</span><br>                  
                            <span class="value" id="high_price">{{@number_format(@$company_details['HIGHPRICE'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Low Price</span><br>                  
                            <span class="value" id="low_price">{{@number_format(@$company_details['LOWPRICE'],2)}}</span>              
                        </div>          
                    </div>  
                 </div>
                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose">{{@number_format(@$company_details['PrevLtp'],2)}}</span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Spot Price</span><br>
                            <span class="value" id="spot_price">{{@number_format(@$company_details['Nseltp'],2)}}</span>              
                        </div>          
                    </div>    
                 </div>
            </div>
            <div class="row marketDetails bt">  
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">Bid Price</span><br>                  
                            <span class="value" id="bid_price">{{@number_format(@$company_details['BBUYPRICE'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Bid Quantity</span><br>                  
                            <span class="value" id="bid_qty">{{@number_format(@$company_details['BBUYQTY'],2)}}</span>              
                        </div>  
                    </div>
                </div>
                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Offer Price</span><br>                  
                            <span class="value" id="offer_price">{{@number_format(@$company_details['BSELLPRICE'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Offer Quantity</span><br>                  
                            <span class="value" id="offer_qty">{{@number_format(@$company_details['BSELLQTY'],2)}}</span>              
                        </div>          
                    </div>  
                 </div>
                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Avg. Price</span><br>                  
                            <span class="value" id="avg_price">{{@number_format(@$company_details['AVGTP'],2)}}</span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">No. of Contracts Traded</span><br>
                            <span class="value" id="contra_trad">{{@number_format(@$company_details['TradedQtyCnt'],2)}}</span>              
                        </div>          
                    </div>    
                 </div>
            </div>
            <div class="marketDetails row bt">
                <div class="col-md-4">          
                    <div class="row ">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Turnover (in Lakhs)</span><br>                  
                            <span class="value" id="turnover">{{@number_format(@$company_details['Turnover'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Traded Quantity</span><br>                  
                            <span class="value" id="trad_qty">{{@number_format(@$company_details['Volume'],2)}}</span>              
                        </div>          
                    </div> 
                </div>
                <div class="col-md-4">     
                    <div class="row">              
                         <div class="col-6 col-md-6">                  
                            <span class="name">Market Lot</span><br>                  
                            <span class="value" id="market_lot">
                            {{@number_format(@$company_details['MktLot'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Interest</span><br>                  
                            <span class="value" id="open_intrest">{{@number_format(@$company_details['OPENINTEREST'],2)}}</span>              
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Open Int. Chg</span><br>
                            @php 
                            if(@$company_details['DiffOpenInt'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp              
                            <span class="value <?php echo $lbClass; ?>" id="DiffOpenInt">
                              {{@number_format(@$company_details['DiffOpenInt'],2)}}
                            </span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open Int. Chg%</span><br>
                            @php 
                            if(@$company_details['chgOpenInt'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp                  
                            <span class="value {{$lbClass}}" id="chgOpenInt">
                              {{@number_format(@$company_details['chgOpenInt'],2)}}
                            </span>              
                        </div>          
                    </div>  
                </div>   
            </div>
        </div>
    @if(@$ajaxLoad)
  @else
    </div>
  @endif
    
@endif