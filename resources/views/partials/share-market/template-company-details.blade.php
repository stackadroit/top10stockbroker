<div class="section-companyprice bg-light section-padding mb-5"  id="stock-market-live">
        <div class="inner-wrap px-3">
          @php
            $indecName =@$indices_details['INDEX_NAME'];
            $indexCode =@$indices_code;
            $apiExchg =@$api_exchg;
          @endphp

            <div class="row align-items-center mb-4"> 
                
                <div class="col-md-2 full-box order-md-2">
                    <div class="select-theme-stb">  
                    <form method="post">     
                        <select name="indices_index" id="indicesIndexes" class="">
                            @php
                            foreach($indices_filter as $pt){
                            $flt_ind_idx = get_post_meta($pt->ID, 'indices_code', true );
                                @endphp
                                <option value="{{@$flt_ind_idx}}" {{($flt_ind_idx == @$indexCode)?'selected="selected"':''}}>
                                  {{$pt->post_title}}
                                    </option>
                                @php
                                }
                            @endphp
                        </select>
                     </form>
                    </div>
                </div>
                <!-- col-2 full-box -->            
                <div class="col-md-4">      
                    <h2 class="names" id="indecName" data-indices-code="{{$indexCode}}" style="margin: 0px; padding:0;" title="{{$indecName}}">{{$indecName}}</h2>
                    <div class="index"> 
                        <span class="group"> 
                            <span>Exchange : </span><span id="bse-value" class="index-val">{{$apiExchg}}</span>
                        </span> 
                    </div>    
                    <!-- index -->
                </div>
                <!-- col-4 -->
                <div class="col-md-6 valuesDiv"> 
                    @php
                    if(@$indices_details['CHANGE'] >0){
                        $arrowClass ="fa-arrow-up color-green";
                        $lavelClass ="color-green";
                    }else{
                        $arrowClass ="fa-arrow-down color-red";
                        $lavelClass ="color-red";
                    }
                    @endphp
                    <div class="value">              
                        <span class="fas sm-icon-box {{ $arrowClass}}" id="currentStockRateArrow"></span>              
                        <span class="" id="currentStockRate">{{ @number_format(@$indices_details['PRICE'],2) }}</span>              
                    </div>          
                    <div class="change">Change: <span class="{{ $lavelClass }}" id="currentStockChange">{{ @number_format(@$indices_details['CHANGE'],2)}} ({{ @number_format(@$indices_details['PER_CHANGE'],2) }}%)</span></div>      
                </div>
                <!-- col-6 valuesDiv -->

            </div>
            <!-- row -->

            <div class="row marketDetails bb bt" id="3">  
                <div class="col-md-4">          
                    <div class="row">              
                        <div class="col-md-6 col-6">                  
                            <span class="name">52 week Low</span><br>                  
                            <span class="value" id="52weeklow">{{ @number_format(@$indices_details['52WEEKLOW'],2) }}</span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">52 week High</span><br>                  
                            <span class="value" id="52weekhigh">{{ @number_format(@$indices_details['52WEEKHIGH'],2) }}</span>              
                        </div>          
                    </div>   
                    <!-- row -->
                 </div>   
                 <!-- col-md-4 -->
                 <div class="col-md-4">          
                    <div class="row">              
                        <div class="col-md-6 col-6">                  
                            <span class="name">Day low</span><br>                  
                            <span class="value" id="daylow">{{ @number_format(@$indices_details['LOW'],2) }}</span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Day high</span><br>                  
                            <span class="value" id="dayhigh">{{ @number_format(@$indices_details['HIGH'],2) }}</span>              
                        </div>          
                    </div>  
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->

                 <div class="col-md-4">          
                    <div class="row">  
                       <div class="col-md-6 col-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose">{{ @number_format(@$indices_details['PREV_CLOSE'],2) }}</span>              
                        </div>       
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Open</span><br>                  
                            <span class="value" id="open">{{ @number_format(@$indices_details['OPEN'],2) }}</span>              
                        </div> 
                    </div>
                </div>

            </div>
            <!-- /.marketDetails -->



            <div id="4" class="marketDetails row mb-0 pb-0">
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-md-6 col-6">                  
                            <span class="name">1W return%</span><br> @php 
                            if(@$indices_details['WEEKPERCHANGE'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp               
                            <span class="value {{ $lbClass }}" id="1wreturn">
                              {{ @number_format(@$indices_details['WEEKPERCHANGE'],2) }}
                            </span>              
                        </div>       
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">1M return%</span><br>
                            @php
                            if(@$indices_details['MONTHPERCHANGE'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp                   
                            <span class="value {{ $lbClass }}" id="1mreturn">
                              {{ @number_format(@$indices_details['MONTHPERCHANGE'],2) }}
                            </span>              
                        </div>          
                    </div>  
                    <!-- row -->
                </div>   
                <!-- col-md-4 -->
                <div class="col-md-4">          
                    <div class="row">    
                         <div class="col-md-6 col-6">                  
                            <span class="name">6M return%</span><br> @php
                            if(@$indices_details['6MONTHPERCHANGE'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp              
                            <span class="value {{ $lbClass }}" id="6mreturn">
                              {{ @number_format(@$indices_details['6MONTHPERCHANGE'],2) }}
                            </span>              
                        </div>    
                             
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">1Y return%</span><br>
                            @php
                            if(@$indices_details['1YEARPERCHANGE'] >0){
                              $lbClass="text-green";
                            }else{
                              $lbClass="text-red";
                            }
                            @endphp                  
                            <span class="value {{ $lbClass}}" id="1yreturn">
                               {{ @number_format(@$indices_details['1YEARPERCHANGE'],2) }} 
                            </span>              
                        </div>       
                    </div>
                    <!-- row -->
                </div>
                <!-- col-md-4 -->
                <div class="col-md-4">  
                    <div class="row"> 
                        <div class="col-md-6 col-6">                  
                            <span class="name">Advances</span><br>                  
                            <span class="value" id="mcaprs">{{ @number_format(@$indices_details['ADV'],2) }}</span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Declines</span><br>                  
                            <span class="value" id="totalrs">{{ @number_format(@$indices_details['DEC'],2) }}</span>              
                        </div>  
                    </div>  
                    <!-- row -->
                </div>
                <!-- col-md-4 -->
            </div>
            <!-- marketDetails -->
        </div>
        <!-- /.inner -->
    </div>