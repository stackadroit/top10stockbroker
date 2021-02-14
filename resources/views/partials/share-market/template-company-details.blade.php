<div id="filter-options" data-pid="{{get_the_ID()}}" data-iicode="{{@$indices_code}}"></div>
<div class="section-companyprice bg-light section-padding mb-5"  id="stock-market-live">
        <div class="inner-wrap px-3">
          @php
            //$indecName =@$indices_details['INDEX_NAME'];
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
                    <h2 class="names" id="indecName" data-indices-code="{{$indexCode}}" style="margin: 0px; padding:0;" title="{{$indecName}}">{{@$indecName}}</h2>
                    <div class="index"> 
                        <!-- <span class="group"> 
                            <span>Exchange : </span><span id="bse-value" class="index-val">{{$apiExchg}}</span>
                        </span>  -->
                    </div>    
                    <!-- index -->
                </div>
                <!-- col-4 -->
                <div class="col-md-6 valuesDiv px-0"> 
                    <div class="value">              
                        <span class="fas sm-icon-box" id="currentStockRateArrow"></span>
                        <span class="" id="currentStockRate"></span>              
                    </div>          
                    <div class="change">Change: <span class="" id="currentStockChange"></span></div>      
                </div>
                <!-- col-6 valuesDiv -->

            </div>
            <!-- row -->

            <div class="row marketDetails bb bt" id="3">  
                <div class="col-md-4">          
                    <div class="row">              
                        <div class="col-md-6 col-6">                  
                            <span class="name">52 week Low</span><br>                  
                            <span class="value" id="52weeklow"></span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">52 week High</span><br>                  
                            <span class="value" id="52weekhigh"></span>              
                        </div>          
                    </div>   
                    <!-- row -->
                 </div>   
                 <!-- col-md-4 -->
                 <div class="col-md-4">          
                    <div class="row">              
                        <div class="col-md-6 col-6">                  
                            <span class="name">Day low</span><br>                  
                            <span class="value" id="daylow"></span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Day high</span><br>                  
                            <span class="value" id="dayhigh"></span>              
                        </div>          
                    </div>  
                    <!-- row -->
                 </div>
                 <!-- col-md-4 -->

                 <div class="col-md-4">          
                    <div class="row">  
                       <div class="col-md-6 col-6">                  
                            <span class="name">Prev Close</span><br>                  
                            <span class="value" id="prevclose"></span>              
                        </div>       
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Open</span><br>                  
                            <span class="value" id="open"></span>              
                        </div> 
                    </div>
                </div>

            </div>
            <!-- /.marketDetails -->



            <div id="4" class="marketDetails row mb-0 pb-0">
                <div class="col-md-4">          
                    <div class="row">       
                        <div class="col-md-6 col-6">                  
                            <span class="name">1W return%</span><br>
                            <span class="value" id="1wreturn">
                            </span>              
                        </div>       
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">1M return%</span><br>
                            <span class="value " id="1mreturn">
                            </span>              
                        </div>          
                    </div>  
                    <!-- row -->
                </div>   
                <!-- col-md-4 -->
                <div class="col-md-4">          
                    <div class="row">    
                         <div class="col-md-6 col-6">                  
                            <span class="name">6M return%</span><br>              
                            <span class="value" id="6mreturn">
                            </span>              
                        </div>    
                             
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">1Y return%</span><br>
                            <span class="value" id="1yreturn">
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
                            <span class="value" id="mcaprs"></span>              
                        </div>              
                        <div class="col-md-6 col-6 text-right">                  
                            <span class="name">Declines</span><br>                  
                            <span class="value" id="totalrs"></span>              
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