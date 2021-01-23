 @php
    if($company_details){
    @endphp
    <div class="section-companyprice bg-light section-padding mb-5"  id="company-stock-live">
        <div class="inner-wrap px-3">
          <?php
            // echo '<pre>';
            // print_r($cDetailsresponse);
            // echo '</pre>';
           ?>
            <div class="row align-items-center mb-4"> 
                <div class="col-md-2 full-box order-md-last">
                    <div class="select-theme-stb">          
                        <select name="" id="ddlCompanyIndexes" class="">
                            @if($cpnlisted_db  ==3)
                                    <option value="NSE">NSE</option>
                                    <option value="BSE">BSE</option>
                                @elseif($cpnlisted_db ==2)
                                    <option value="BSE">BSE</option>
                                @else
                                    <option value="NSE">NSE</option>
                                @endif
                        </select>
                    </div>
                </div>
                <!-- col-2 full-box -->
                <div class="col-md-4">      
                    <h2 class="names" id="company-name" style="margin: 0px; padding:0;" title="{{@$comp_name}}">{{@$comp_name}}</h2>
                    <div class="index"> 
                        <span class="group"> 
                            <span>BSE : </span><span id="bse-value" class="index-val border-right">{{@$company_details['scripcode']}}</span>
                        </span> 
                        <span class="group"> 
                            <span>NSE : </span><span id="nse-value" class="index-val border-right">{{@$company_details['symbol']}}</span>
                        </span> 
                        <span class="group"> 
                            <span>Sector : </span><span id="sector-value"  class="index-val" title="Banks">{{@$company_details['Sector']}}</span>
                        </span>
                    </div>    
                    <!-- index -->
                </div>
                <!-- col-4 -->
                <div class="col-md-6 valuesDiv"> 
                  @php
                    if(@$company_details['CHANGE'] >0 ){
                      $arrowClass ="fa-arrow-up color-green";
                      $lavelClass ="color-green";
                    }else{
                      $arrowClass ="fa-arrow-down color-red";
                      $lavelClass ="color-red";
                    }
                    @endphp         
                    <div class="value">              
                        <span class="fas sm-icon-box {{$arrowClass }}" id="currentStockRateArrow"></span>              
                        <span class="" id="currentStockRate">{{@number_format(@$company_details['CLOSE'],2)}}</span>              
                    </div>          
                    <div class="change">Change: <span class="{{$lavelClass}}" id="currentStockChange">{{@number_format(@$company_details['CHANGE'],2)}} ({{@number_format(@$company_details['PER_CHANGE'],2) }}%)</span></div>      
                </div>
                <!-- col-6 valuesDiv -->
            </div>
            <!-- row -->

            <div class="row marketDetails bb bt" id="3">  
                
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">52 week Low</span><br>                  
                            <span class="value" id="52weeklow">{{@number_format(@$company_details['52WeekLow'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">52 week High</span><br>                  
                            <span class="value" id="52weekhigh">{{@number_format(@$company_details['52WeekHigh'],2)}}</span>              
                        </div>  
                    </div>
                </div>
                <!-- col-md-4 -->

                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Day low</span><br>                  
                            <span class="value" id="daylow">{{@number_format(@$company_details['LOW'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Day high</span><br>                  
                            <span class="value" id="dayhigh">{{@number_format(@$company_details['High'],2)}}</span>              
                        </div>          
                    </div>  
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->

                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose">{{@number_format(@$company_details['PREV_CLOSE'],2)}}</span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open</span><br>                  
                            <span class="value" id="open">{{@number_format(@$company_details['OPEN'],2)}}</span>              
                        </div>          
                    </div>    
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->
            </div>
            <!-- /.marketDetails -->



            <div id="4" class="marketDetails row">
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">6M return%</span><br> @php 
                            if(@$company_details['6MonthPerChange'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp               
                            <span class="value {{$lbClass}}" id="6mreturn">
                              {{@number_format(@$company_details['6MonthPerChange'],2)}}
                            </span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">1Y return%</span><br>
                            @php 
                            if(@$company_details['1YearPerChange'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp                 
                            <span class="value {{$lbClass}}" id="1yreturn">
                              {{@number_format(@$company_details['1YearPerChange'],2)}}
                            </span>              
                        </div>          
                    </div>  
                    <!-- row -->
                </div>   
                <!-- col-md-4 -->

                <div class="col-md-4">          
                    <div class="row ">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">MCap(Rs. in Million)</span><br>                  
                            <span class="value" id="mcaprs">{{@number_format(@$company_details['MCAP'],2)}}</span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Total Volume</span><br>                  
                            <span class="value" id="totalrs">{{@number_format(@$company_details['VOLUME'],2)}}</span>              
                        </div>          
                    </div> 
                    <!-- row -->
                </div>
                <!-- col-md-4 -->

                <div class="col-md-4">     
                    <div class="row">              
                        <div class="col-md-12 market-small-details">                  
                            <div>                      
                                <span class="head-val">Face Value :</span>                      
                                <span class="icon-rupees_1"></span>                      
                                <span id="facevalue">{{@$company_details['FV']}}</span>                  
                            </div>                  
                             
                            <div>                      
                                <span class="head-val">Listed Since </span>                      
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- col-md-4 -->
            </div>
            <!-- marketDetails -->



            <div class="row comparison">
                <div class="col item">
                    <div class="fa fa-question-circle popoverTigger">
                        <div class="popoverBox">
                            <span class="text-blue">PE Ratio</span>
                            <br>
                            <p class="para2">Is the price-earnings ratio for valuing a company that measures its current share price relative to its earnings per share.</p>
                        </div>
                    </div>
                    <div class="name">P/E RATIO</div>
                    <div class="value" id="peRatio">{{@number_format(@$company_details['PE'],2)}}</div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fa fa-question-circle popoverTigger">
                        <div class="popoverBox">
                            <span class="text-blue">EPS</span>
                            <br>
                            <p class="para2">The earnings per share ratio is a portion of company's net profit allocated for each outstanding share. It is calculated by deducting preferred stock divided from the net income of the company divided by the number of outstanding shares.</p>
                        </div>
                    </div>
                    <div class="name">EPS</div>
                    <div class="value" id="epsRATIO">{{@number_format(@$company_details['EPSc'],2)}}</div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fa fa-question-circle popoverTigger">
                        <div class="popoverBox">
                            <span class="text-blue">MCAP SALES</span>
                            <br>
                            <p class="para2">MCAP SALES is used to compared the company's current market price with its mcap sales value. </p>
                        </div>
                    </div>
                    <div class="name">MCAP SALES</div>
                    <div class="value" id="bvRatio">{{@number_format(@$company_details['MCAP_SALES'],2) }}</div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fa fa-question-circle popoverTigger">
                        <div class="popoverBox">
                            <span class="text-blue">Deliverable</span>
                            <br>
                            <p class="para2">These are the acutal number of shares that are traded on delivery based, meaning transfered from one person to another during the day's trade.</p>
                        </div>
                    </div>
                    <div class="name">DELIVERABLES</div>
                    <div class="value" id="deliverableRatio">{{@number_format(@$company_details['Deliverable'],2)}}</div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fa fa-question-circle popoverTigger">
                        <div class="popoverBox">
                            <span class="text-blue">DIV YIELD.(%)</span>
                            <br>
                            <p class="para2">Dividend Yield measures the quantum of cash dividends paid to shareholders in a financial year relative to the market value of the per share.</p>
                        </div>
                    </div>
                    <div class="name">DIV YIELD.(%)</div>
                    <div class="value" id="dividendRatio">{{@number_format(@$company_details['YIELD'],2) }}</div>
                </div>
                <!-- item -->
            </div>
            <!-- /.comparison -->

        </div>
        <!-- /.inner -->
    </div>
@php } @endphp