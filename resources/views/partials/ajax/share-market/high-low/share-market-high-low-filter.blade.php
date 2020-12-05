@php
if(is_array($indicesStocks) && count($indicesStocks)){
        $idx =1;
        foreach ($indicesStocks as $key => $stock) {
       @endphp
            <div class="companyList" id="stock-list-{{$idx}}">
               <div class="row mb20">
                  <div class="col-12">
                    <a href="{{site_url('/') . @$acc_companyLists[@$stock->FINCODE]}}" title="{{@$stock->COMPNAME }}">
                        <span class="cd-heading text-orange">
                        {{(@$stock->COMPNAME)?@$stock->COMPNAME:'-'}}
                        </span>
                     </a>
                  </div>
               </div>
               <!-- row -->
                   <div class="row companydata scrollbar-inner">
                    <div class="compData-item">
                        <span class="cd-head">LTP</span>
                        <span class="cd-val">
                            {{(@$stock->CLOSE_PRICE)?@$stock->CLOSE_PRICE:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Change</span>
                        <span class="cd-val {{(@$stock->CHANGE >0)?'text-green':'text-red'}}">
                            {{(@$stock->CHANGE)?@$stock->CHANGE:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Change %</span>
                        <span class="cd-val {{(@$stock->PER_CHANGE >0)?'text-green':'text-red'}}">
                            {{(@$stock->PER_CHANGE)?@$stock->PER_CHANGE:'-'}}
                        </span>
                    </div>

                    <div class="compData-item">
                        <span class="cd-head">Volume(Mil.)</span>
                        <span class="cd-val">
                            {{(@$stock->VOLUME)?@$stock->VOLUME:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Turnover(Mil.)</span>
                        <span class="cd-val">
                            {{(@$stock->TURNOVER)?@$stock->TURNOVER:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Past 30 Day's Price</span>
                        <span class="cd-val">
                            {{(@$stock->MONTHPRICE)?@$stock->MONTHPRICE:'-'}}
                        </span>
                    </div>

                    <div class="compData-item">
                        <span class="cd-head">30 Day's % chg</span>
                        <span class="cd-val">
                            {{(@$stock->MONTHPERCHANGE)?@$stock->MONTHPERCHANGE:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Past 365 Day's Price</span>
                        <span class="cd-val {{(@$stock->YEARPRICE >0)?'text-green':'text-red'}}">
                            {{(@$stock->YEARPRICE)?@$stock->YEARPRICE:'-'}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">365 Day's % chg</span>
                        <span class="cd-val {{(@$stock->YEARPERCHANGE >0)?'text-green':'text-red'}}">
                            {{(@$stock->YEARPERCHANGE)?@$stock->YEARPERCHANGE:'-'}}
                        </span>
                    </div>
               </div>
               <!-- row -->
            </div>  
            @php
            $idx++;
        }
        if($totalPage > $page_no){
            @endphp
            <div class="alm-btn-wrap" id="loadMoreWrap">
              <button class="alm-load-more-btn" id="loadMoreHighLow" href="javascript:void(0);" data-page_no="{{$page_no}}">Load More</button>
            </div>
            @php
        }
        echo "</div>";
         
    } 
    @endphp
    