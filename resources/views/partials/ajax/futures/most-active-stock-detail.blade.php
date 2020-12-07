<div class="section-companydetails section-padding">
    <div class="inner-wrap">
          <h1 class="text-orange">{{@$get_detail_page['main_section_title']}}</h1>
          <p>{{@$get_detail_page['main_section_content']}}</p>
    </div>
</div>
 <div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h1 class="">{{@$get_detail_page['section_title']}}</h1>
          <p>{{@$get_detail_page['section_content']}}</p>
        </div>
         <div class="row align-items-end n-tab-wrap">
          <ul class="tabs commn_tabs col-md-9">
              <li><a href="#mostActiveStockVolume" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Volume</a></li>
              <li><a href="#mostActiveStockValue" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Value</a></li>
              <li><a href="#mostActiveStockGainers" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Gainers</a></li>
          </ul>
          <div class="commn_tabs col-md-3" >
          <label>Exp. Date</label> 
                <select id="mostActiveStockExpiryDate" class="select-style1">
                  @php foreach($ExpiryDateFilter as $lprow){ @endphp
                    <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                    @php } @endphp
                 </select>
          </div>
        </div>
        
        <div id="mostActiveStockVolume" class="tab_content">
          <div class="scrollbar-inner">
            <table class="table-style1 mb-20">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <!-- <th class="big-font">Strike Price</th> -->
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
                  if(@$get_detail_page['volumeTableTotalRow']){ 
                    foreach ($get_detail_page['volumeAnalysis'] as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                    @endphp
                      <tr>
                       <td>
                        @php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                            @endphp
                            <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                          @php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                         @endphp
                        </td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) ?></td> -->
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
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
            @php if($get_detail_page['volumeTableTotalRow'] > $PageSize){ @endphp
            <div class="alm-btn-wrap" id="loadMoreWrap_vol">
              <button class="alm-load-more-btn" id="loadMore_vol" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['volumeTableTotalRow']}}">Load More</button>
            </div>
            @php } @endphp
        </div>
     
        <div id="mostActiveStockValue" class="tab_content">
            <div class="scrollbar-inner">
            <table class="table-style1 mb-20">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <!-- <th class="big-font">Strike Price</th> -->
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
                  if(@$get_detail_page['valueTableTotalRow']){ 
                    foreach ($get_detail_page['valueAnalysis'] as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>
                        @php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                           @endphp
                            <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                          @php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                          @endphp
                        </td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) ?></td> -->
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
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
            @php if(@$get_detail_page['valueTableTotalRow'] > $PageSize){  @endphp
            <div class="alm-btn-wrap" id="loadMoreWrap_val">
              <button class="alm-load-more-btn" id="loadMore_val" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['valueTableTotalRow']}}">Load More</button>
            </div>
          @php }  @endphp
        </div>
     
        <div id="mostActiveStockGainers" class="tab_content">
          <div class="scrollbar-inner">
            <table class="table-style1 mb-20">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <!-- <th class="big-font">Strike Price</th> -->
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
                  if(@$get_detail_page['gainerTableTotalRow']){ 
                    foreach ($get_detail_page['gainerAnalysis'] as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>
                        @php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                           @endphp
                            <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                          @php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                          @endphp
                        </td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) ?></td> -->
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
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
            @php if(@$get_detail_page['gainerTableTotalRow'] >$PageSize ) {  @endphp
            <div class="alm-btn-wrap" id="loadMoreWrap_G">
              <button class="alm-load-more-btn" id="loadMore_G" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['gainerTableTotalRow']}}">Load More</button>
            </div>
          @php }  @endphp
        </div> 
        </div>
    </div>
</div>
 