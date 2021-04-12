<div id="filter-options" data-post-id="{{get_the_ID()}}" data-sector="" data-company-name="{{$comp_name}}" data-fincode="{{$fin_code}}" data-apiexchg="{{$api_exchg}}" data-details="" ></div>
<div class="section-companyprice bg-light section-padding mb-5"  id="company-stock-live">
        <div class="inner-wrap px-3">
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
                <div class="col-md-4">      
                    <h2 class="names" id="company-name" style="margin: 0px; padding:0;" title=""></h2>
                    <div class="index"> 
                        <span class="group"> 
                            <span>BSE : </span><span id="bse-value" class="index-val border-right"></span>
                        </span> 
                        <span class="group"> 
                            <span>NSE : </span><span id="nse-value" class="index-val border-right"></span>
                        </span> 
                        <span class="group"> 
                            <span>Sector : </span><span id="sector-value"  class="index-val" title="Banks"></span>
                        </span>
                    </div>    
                </div>
                <div class="col-md-6 valuesDiv"> 
                    <div class="value">              
                        <span class="fas sm-icon-box" id="currentStockRateArrow"></span>              
                        <span class="" id="currentStockRate"></span>              
                    </div>          
                    <div class="change">Change: <span class="" id="currentStockChange"></span></div>      
                </div>
            </div>
            <div class="row marketDetails bb bt" id="3">  
                
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6 col-md-6">                  
                            <span class="name">52 week Low</span><br>                  
                            <span class="value" id="52weeklow"></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">52 week High</span><br>                  
                            <span class="value" id="52weekhigh"></span>              
                        </div>  
                    </div>
                </div>
                 <div class="col-md-4">        
                    <div class="row">              
                        <div class="col-6 col-md-6">                  
                            <span class="name">Day low</span><br>                  
                            <span class="value" id="daylow"></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Day high</span><br>                  
                            <span class="value" id="dayhigh"></span>              
                        </div>          
                    </div>  
                 </div>
                 <div class="col-md-4">
                    <div class="row ">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose"></span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Open</span><br>                  
                            <span class="value" id="open"></span>              
                        </div>          
                    </div>    
                 </div>
            </div>
            <div id="4" class="marketDetails row">
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-6 col-md-6">                  
                            <span class="name">6M return%</span><br>              
                            <span class="value" id="6mreturn">
                            </span>              
                        </div>       
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">1Y return%</span><br>
                            <span class="value" id="1yreturn">
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
                            <span class="value" id="mcaprs"></span>              
                        </div>              
                        <div class="col-6 col-md-6 text-right">                  
                            <span class="name">Total Volume</span><br>                  
                            <span class="value" id="totalrs"></span>              
                        </div>          
                    </div> 
                </div>
                <div class="col-md-4">     
                    <div class="row">              
                        <div class="col-md-12 market-small-details">                  
                            <div>                      
                                <span class="head-val">Face Value :</span>                      
                                <span class="icon-rupees_1"></span>                      
                                <span id="facevalue"></span>                  
                            </div>                  
                             
                            <div>                      
                                <span class="head-val">Listed Since </span>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row comparison">
                <div class="col item">
                    <div class="fas fa-question-circle popoverTigger">
                    </div>
                        <div class="popoverBox">
                            <span class="popover-title">PE Ratio</span>
                            <br>
                            <p class="para2">Is the price-earnings ratio for valuing a company that measures its current share price relative to its earnings per share.</p>
                        </div>
                    <div class="name">P/E RATIO</div>
                    <div class="value" id="peRATIO">
                    </div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fas fa-question-circle popoverTigger"></div>
                        <div class="popoverBox">
                            <span class="popover-title">EPS</span>
                            <br>
                            <p class="para2">The earnings per share ratio is a portion of company's net profit allocated for each outstanding share. It is calculated by deducting preferred stock divided from the net income of the company divided by the number of outstanding shares.</p>
                        </div>
                    <div class="name">EPS</div>
                    <div class="value" id="epsRATIO"></div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fas fa-question-circle popoverTigger"></div>
                        <div class="popoverBox">
                            <span class="popover-title">MCAP SALES</span>
                            <br>
                            <p class="para2">MCAP SALES is used to compared the company's current market price with its mcap sales value. </p>
                        </div>
                    <div class="name">MCAP SALES</div>
                    <div class="value" id="bvRatio"></div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fas fa-question-circle popoverTigger"></div>
                        <div class="popoverBox">
                            <span class="popover-title">Deliverable</span>
                            <br>
                            <p class="para2">These are the acutal number of shares that are traded on delivery based, meaning transfered from one person to another during the day's trade.</p>
                        </div>
                    <div class="name">DELIVERABLES</div>
                    <div class="value" id="deliverableRatio"></div>
                </div>
                <!-- item -->
                <div class="col item">
                    <div class="fas fa-question-circle popoverTigger"></div>
                        <div class="popoverBox">
                            <span class="popover-title">DIV YIELD.(%)</span>
                            <br>
                            <p class="para2">Dividend Yield measures the quantum of cash dividends paid to shareholders in a financial year relative to the market value of the per share.</p>
                        </div>
                    <div class="name">DIV YIELD.(%)</div>
                    <div class="value" id="dividendRatio"></div>
                </div>
            </div>
        </div>
    </div>
