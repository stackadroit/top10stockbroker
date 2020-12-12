<div class="section-companydetails section-padding">
    <div class="inner-wrap">
          <h1 class="text-orange">{{@$get_detail_page['main_h1_title']}}</h1>
          <p>{{@$get_detail_page['main_para_content']}}</p>
    </div>
</div>
 <div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">

        <div class="section-head">
            <h2 class="">{{@$get_detail_page['section_title']}}</h2>
            <p>{{@$get_detail_page['section_content']}}</p>
          </div>
         <input type="hidden" id="ActiveInstName" value="{{@$get_detail_page['InstName']}}">
        <div class="row n-tab-wrap">
          <ul class="tabs commn_tabs col-md-8">
            <li><a href="#mostActiveStockIndexOptionCall"   class="changeMASIOFilter" data-expdate="{{@$get_detail_page['ExpDate']}}" data-rtypefilter="{{@$get_detail_page['Rtype']}}">CALL</a></li>
            <li><a href="#mostActiveStockIndexOptionPut"   class="changeMASIOFilter" data-expdate="{{@$get_detail_page['ExpDate']}}" data-rtypefilter="{{@$get_detail_page['Rtype']}}">PUT</a></li>
          </ul>
              <div class="commn_tabs col-md-4">
              <label>Exp. Date</label>
                    <select id="mostActiveStockIndexOptionExpiryDate" class="select-style1">
                      @php foreach(@$get_detail_page['ExpiryDateFilter'] as $lprow){ @endphp
                        <option {{(@$get_detail_page['ExpDate'] ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                      @php } @endphp
                     </select>
                  </select>

                  <select id="mostActiveStockIndexOptionFilter" class="select-style1">
                     <option value="vol">Volume</option>
                     <option value="val">Value</option>
                     <option value="G">Gainers</option>
                     <option value="L">Losers</option>
                  </select>
            </div>
        <!-- /.tabs -->
        </div>
      <div id="mostActiveStockIndexOptionCall" class="tab_content">
          <div class="scrollbar-inner">
          <table class="table-style1 mb-20">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
                     <th class="big-font">LTP</th>
                     <th class="big-font">Prev. LTP</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">OI Value</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">Quantity</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array(@$get_detail_page['cVol'])){ 
                    foreach (@$get_detail_page['cVol'] as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol']}}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['StrikePrice'],2)}}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
                    </tr>
                    @php
                      }
                    }else{
                      echo '<tr><td colspan="2">No Record Found!</div>';
                    }
                  @endphp
                 </tbody>
            </table>
            </div>
            <div class="alm-btn-wrap" id="loadMoreWrapC">
              <button class="alm-load-more-btn" id="loadMoreC" href="javascript:void(0);" data-page_no="1" data-total="{{@$get_detail_page['ctableTotalRow']}}">Load More</button>
            </div> 
        </div>
        <div id="mostActiveStockIndexOptionPut" class="tab_content">
          <div class="scrollbar-inner">
            <table class="table-style1 mb-20">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
                     <th class="big-font">LTP</th>
                     <th class="big-font">Prev. LTP</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">OI Value</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">Quantity</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array(@$get_detail_page['pVol'])){ 
                    foreach (@$get_detail_page['pVol'] as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol']}}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['StrikePrice'],2)}}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
                    </tr>
                   @php
                      }
                    }else{
                      echo '<tr><td colspan="2">No Record Found!</div>';
                    }
                  @endphp
                 </tbody>
            </table>
          </div>
            <div class="alm-btn-wrap" id="loadMoreWrapP">
              <button class="alm-load-more-btn" id="loadMoreP" href="javascript:void(0);" data-page_no="1" data-total="{{@$get_detail_page['ptableTotalRow']}}">Load More</button>
            </div>
        </div>
    </div>
</div>