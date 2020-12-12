<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
          <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
          <div class="row align-items-end n-tab-wrap">
            <input type="hidden" id="SIsection" value="{{$section}}">
          <ul class="tabs commn_tabs col-md-8">
              <li><a href="#stocksPutCallRatios" class="changeSIFilter" data-expdate="{{@$SExpDate}}" data-reporttype="{{@$ReportType}}">Stocks</a></li>
              <li><a href="#indexesPutCallRatios" class="changeSIFilter" data-expdate="{{@$IExpDate}}" data-reporttype="{{@$ReportType}}">Indexes</a></li>
                  
          </ul>
          <div id="stk-filter" class="commn_tabs col-md-4">
            <label>Exp. Date</label>
                <select id="stockExpireDateFilter" class="select-style1">
                  @php foreach($SExpiryDateFilter as $lprow){ @endphp
                    <option {{($SExpDate ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                  @php } @endphp
                 </select>
              </select>
              <select id="stockReportTypeFilter" class="select-style1">
                 <option value="vol">Volume</option>
                 <option value="OI">Interest</option>
              </select>
          </div>
          <div id="idx-filter" class="commn_tabs col-md-4" style="display: none">
            <label>Exp. Date</label>
                <select id="indexExpireDateFilter" class="select-style1">
                  @php foreach($IExpiryDateFilter as $lprow){ @endphp
                    <option {{($IExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                  @php } @endphp
                 </select>
              </select>
              <select id="indexReportTypeFilter" class="select-style1">
                 <option value="vol">Volume</option>
                 <option value="OI">Interest</option>
              </select>
            </div>
          </div>
    @if(is_array(@$stockCPAnalysis))
        <div id="stocksPutCallRatios" class="tab_content">
          <div class="scrollbar-inner">
            <table class="table-style1 elm-vartival-table mb-0">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Put OI</th>
                     <th class="big-font">Call OI</th>
                     <th class="big-font">Put Call Ratio</th>
                   </tr>
               <tbody>
                  @php
                  if(is_array($stockCPAnalysis)){ 
                    foreach ($stockCPAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                        <td>
                        @php
                          $smId =@$optionChainSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                            @endphp
                            <a href="<?php @$smbLink ?>" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
                          @php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                         @endphp
                        </td>
                         
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['Put'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Call'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Ratio'],2)}}</td>
                      </tr>
                    @php
                      }
                    }else{
                      echo '<tr><td colspan="10">No Record Found!</div>';
                    }
                   @endphp
                 </tbody>
            </table>
             
           
        </div> 
        </div> 
    @endif
    @if(is_array(@$indexCPAnalysis))
        <div id="indexesPutCallRatios" class="tab_content">
          <div class="scrollbar-inner">
             <table class="table-style1 elm-vartival-table mb-0">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Put OI</th>
                     <th class="big-font">Call OI</th>
                     <th class="big-font">Put Call Ratio</th>
                   </tr>
                </thead>
               <tbody>
 
                  @php
                  if(is_array($indexCPAnalysis)){ 
                    foreach ($indexCPAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      @endphp
                      <tr>
                         <td>
                        @php
                          $smId =@$optionChainSymbol[@$rowObj['Symbol']];
                          if(@$smId){
                            $smbLink =get_the_permalink($smId);
                            @endphp
                            <a href="<?php @$smbLink ?>" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
                          @php
                          }else{
                            echo @$rowObj['Symbol'];
                          }
                         @endphp
                        </td>
                         <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                         <td>{{@number_format(@$rowObj['Put'],2) }}</td>
                         <td>{{@number_format(@$rowObj['Call'],2)}}</td>
                         <td>{{@number_format(@$rowObj['Ratio'],2)}}</td>
                      </tr>
                    @php
                      }
                    }else{
                      echo '<tr><td colspan="10">No Record Found!</div>';
                    }
                  @endphp
                 </tbody>
            </table>
        </div>
        </div>
    @endif
    <div class="view-detail bt">
            <a href="{{site_url('option-chain/put-call-ratio/')}}" target="_blank">Full Details 
              <span class="arr-lis"> > </span>
            </a>
          </div>     
    </div>
</div>