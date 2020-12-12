<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">

        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{$section_content}}</p>
          </div>
        <!-- /.section-head -->
        <input type="hidden" id="most_a_s_o_section" value="{{$section}}">
        <div class="row align-items-end n-tab-wrap">
        <ul class="tabs commn_tabs col-md-8">
          <li><a href="#mostActiveStockOptionCall" data-expdate="{{@$ExpDate}}" class="changeMASOFilter" data-rtypefilter="{{@$Rtype}}">CALL</a></li>
          <li><a href="#mostActiveStockOptionPut" class="changeMASOFilter" data-expdate="{{@$ExpDate}}" data-rtypefilter="{{@$Rtype}}">PUT</a></li>
        </ul>
        <!-- /.tabs -->
        <div class="commn_tabs col-md-4">
        	<label>Exp. Date</label>
              <select id="mostActiveStockOptionExpiryDate" class="select-style1">
                @php foreach($ExpiryDateFilter as $lprow){ @endphp
                  <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                @php } @endphp
               </select>
            </select>
            <select id="mostActiveStockOptionFilter" class="select-style1">
               <option value="vol">Volume</option>
               <option value="val">Value</option>
               <option value="G">Gainers</option>
               <option value="L">Losers</option>
            </select>
          </div>
        </div>
        <div id="mostActiveStockOptionCall" class="tab_content">
           <div class="scrollbar-inner">
          <table class="table-style1 mb-0">
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
                  if(is_array(@$cVol)){ 
                    foreach ($cVol as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol'] }}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate'])) }}</td>
                       <td>{{@number_format(@$rowObj['StrikePrice'],2) }}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2) }}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OI'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
                       <td>{{@number_format(@$rowObj['Qty'],2) }}</td>
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
        </div>
        <div id="mostActiveStockOptionPut" class="tab_content">
           <div class="scrollbar-inner">
            <table class="table-style1 mb-0">
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
                  if(is_array(@$pVol)){ 
                    foreach ($pVol as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol']}}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['StrikePrice'],2)}}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2) }}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OI'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIValue'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
                       <td>{{@number_format(@$rowObj['Qty'],2) }}</td>
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
        </div>
           <div class="view-detail bt">
            <a href="{{site_url('option-chain/most-active-stock-option')}}" target="_blank">Full Details 
              <span class="arr-lis"> > </span>
            </a>
          </div>
    </div>
</div>