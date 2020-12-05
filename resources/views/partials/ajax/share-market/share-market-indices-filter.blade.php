@php
if(is_array($indicesStocks) && count($indicesStocks)){
        $idx =1;
        $pagePerItem =20;
        foreach ($indicesStocks as $key => $stock) {
            if($stock_order =='G' && @$stock->CHANGE <=0){
                continue;
            }
            if($stock_order =='L' && @$stock->CHANGE >0){
                continue;
            }
   @endphp
            <div class="companyList" id="stock-list-{{$idx}}" style="{{($idx >$pagePerItem)?'display:none;':''}}">
               <div class="row mb20">
                  <div class="col-12">
                     <a href="{{site_url('/') . @$acc_companyLists[@$stock->FINCODE]}}" title="{{@$stock->COMPNAME}}">
                        <span class="cd-heading text-orange">
                        {{@$stock->COMPNAME}}
                        </span>
                     </a>
                  </div>
               </div>
               <!-- row -->
               <div class="row companydata scrollbar-inner">
                    <div class="compData-item">
                        <span class="cd-head">LTP</span>
                        <span class="cd-val">
                            {{@$stock->CLOSE_PRICE}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Change</span>
                        <span class="cd-val {{(@$stock->CHANGE >0)?'text-green':'text-red'}}">
                            {{@$stock->CHANGE}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Change% </span>
                        <span class="cd-val {{(@$stock->PER_CHANGE >0)?'text-green':'text-red'}}">
                            {{@$stock->PER_CHANGE}}
                        </span>
                    </div>

                    <div class="compData-item">
                        <span class="cd-head">Volume(Mil.)</span>
                        <span class="cd-val">
                            {{@$stock->VOLUME}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Turnover(Mil.)</span>
                        <span class="cd-val">
                            {{@$stock->TURNOVER}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Past 30 Day's Price</span>
                        <span class="cd-val">
                            {{@$stock->MONTHPRICE}}
                        </span>
                    </div>

                    <div class="compData-item">
                        <span class="cd-head">30 Day's % chg</span>
                        <span class="cd-val">
                            {{@$stock->MONTHPERCHANGE}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">Past 365 Day's Price</span>
                        <span class="cd-val {{(@$stock->YEARPRICE >0)?'text-green':'text-red'}}">
                            {{@$stock->YEARPRICE}}
                        </span>
                    </div>                      
                    <div class="compData-item">
                        <span class="cd-head">365 Day's % chg</span>
                        <span class="cd-val {{(@$stock->YEARPERCHANGE >0)?'text-green':'text-red'}}">
                            {{@$stock->YEARPERCHANGE}}
                        </span>
                    </div>
               </div>
               <!-- row -->
            </div>  
            @php
            $idx++;
        }
        if($idx > $pagePerItem){
          @endphp
            <div class="alm-btn-wrap">
              <button class="alm-load-more-btn" id="loadMore" href="javascript:void(0);">Load More</button>
            </div>
           @php
        }
         
    } 
    @endphp