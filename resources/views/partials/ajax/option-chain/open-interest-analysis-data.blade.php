<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
          </div>
        <ul class="tabs commn_tabs">
            @if(is_array(@$callsAnalysis))
                <li><a href="#OptAnalyCalls">CALL</a></li>
            @endif
            @if(is_array(@$putsAnalysis))
                <li><a href="#OptAnalyPuts">PUT</a></li>
             @endif
        </ul>
    @if(is_array(@$callsAnalysis))
        <div id="OptAnalyCalls" class="tab_content">
           <div class="scrollbar-inner">
            <table class="table-style1 elm-vartival-table">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
                     <th class="big-font">LTP</th>
                     <th class="big-font">Prev. LTP</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">Prev. OI</th>
                     <th class="big-font">OI Change</th>
                     <th class="big-font">OI Change%</th>
                     <th class="big-font">OI Value</th>
                   </tr>
               <tbody>
                @php
                  if(is_array($callsAnalysis)){ 
                    foreach ($callsAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol']}}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['Strikepice'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevOI'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIVAlue'],2)}}</td>
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
    @if(is_array(@$putsAnalysis))
        <div id="OptAnalyPuts" class="tab_content">
           <div class="scrollbar-inner">
             <table class="table-style1 elm-vartival-table">
                <thead>
                    <tr>
                     <th class="big-font">Symbol</th>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
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
                  if(is_array($putsAnalysis)){ 
                    foreach ($putsAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                     @endphp
                      <tr>
                       <td>{{@$rowObj['Symbol']}}</td>
                       <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
                       <td>{{@number_format(@$rowObj['Strikepice'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OI'],2) }}</td>
                       <td>{{@number_format(@$rowObj['PrevOI'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
                       <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OIVAlue'],2)}}</td>
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
    </div>
</div>