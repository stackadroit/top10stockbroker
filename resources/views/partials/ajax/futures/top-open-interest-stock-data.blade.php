<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
          </div>
         <div class="row align-items-end n-tab-wrap">
          <ul class="tabs commn_tabs col-md-9">
          <li><a href="#topInterestStockOptionHighest" class
            ="changeTOISFilter" data-expdate="{{@$ExpDate}}"  >Highest</a></li>
          <li><a href="#topInterestStockOptionLowest" class
            ="changeTOISFilter" data-expdate="{{@$ExpDate}}"  >Lowest</a></li>
        </ul>
        <!-- /.tabs -->
        <div class="commn_tabs col-md-3" >
        <label>Exp. Date</label> 
              <select id="topInterestStockOptionExpiryDate" class="select-style1">
                @php foreach($ExpiryDateFilter as $lprow){ @endphp
                  <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                 @php } @endphp
               </select>
            
        </div>
        </div>
           
        <div id="topInterestStockOptionHighest" class="tab_content">
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
                     <th class="big-font">Prev. OI</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">OI Value</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array(@$hTableData)){ 
                    foreach ($hTableData as $idxKey =>$rowObj){
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
                       <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) ?></td> -->
                       <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevOI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIVAlue'],2)}}</td>
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
        <div id="topInterestStockOptionLowest" class="tab_content">
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
                     <th class="big-font">Prev. OI</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">OI Value</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array(@$lTableData)){ 
                    foreach ($lTableData as $idxKey =>$rowObj){
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
                       <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) ?></td> -->
                       <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevOI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIVAlue'],2)}}</td>
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
            <a href="{{site_url('futures/open-interest-stock-futures')}}" target="_blank">Full Details 
              <span class="arr-lis"> > </span>
            </a>
          </div>
    </div>
</div>