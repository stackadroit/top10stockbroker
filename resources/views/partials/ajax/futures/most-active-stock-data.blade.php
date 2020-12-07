<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <div class="row align-items-end n-tab-wrap">
          <ul class="tabs commn_tabs col-md-9" >
              <li><a href="#mostActiveStockVolume" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Volume</a></li>
              <li><a href="#mostActiveStockValue" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Value</a></li>
              <li><a href="#mostActiveStockGainers" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Gainers</a></li>
          </ul>
          <div class="commn_tabs col-md-3" >
          		<label>Exp. Date</label> 
                <select id="mostActiveStockExpiryDate" class="select-style1">
                  @php 
                  foreach($ExpiryDateFilter as $lprow){ @endphp
                    <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                  @php }  @endphp
                 </select>
          </div>
        </div>
        
        <div id="mostActiveStockVolume" class="tab_content">
            <div class="scrollbar-inner">
            <table class="table-style1 mb-0">
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
                  if(is_array($callsAnalysis)){ 
                    foreach ($callsAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                    @endphp
                      <tr>
                       <td>
                        @php
                          $smId =@$futuresSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                            @endphp
                            <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
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
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
        </div>
     
        <div id="mostActiveStockValue" class="tab_content">
            <div class="scrollbar-inner">
            <table class="table-style1 mb-0">
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
                  if(is_array($putsAnalysis)){ 
                    foreach ($putsAnalysis as $idxKey =>$rowObj){
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
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
        </div>
     
        <div id="mostActiveStockGainers" class="tab_content">
            <div class="scrollbar-inner">
            <table class="table-style1 mb-0">
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
                  if(is_array($gainerAnalysis)){ 
                    foreach ($gainerAnalysis as $idxKey =>$rowObj){
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
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
        </div> 
        <div class="view-detail bt">
            <a href="{{site_url('futures/most-active-stock-futures')}}" target="_blank">Full Details 
              <span class="arr-lis"> > </span>
            </a>
        </div>     
        </div>
    </div>
</div>