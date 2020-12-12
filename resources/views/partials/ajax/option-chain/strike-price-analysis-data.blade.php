<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
          </div>
      <div class="row align-items-end n-tab-wrap">
        <ul class="tabs commn_tabs col-md-9">
            @if(is_array(@$callsAnalysis))
              <li><a href="#Calls"  class="changeSPAFilter" data-expdate="{{@$ExpDate}}">CALL</a></li>
            @endif
            @if(is_array(@$putsAnalysis))
                <li><a href="#Puts" class="changeSPAFilter" data-expdate="{{@$ExpDate}}">PUT</a></li>
            @endif
        </ul>
        <div class="commn_tabs col-md-3">
          <label>Exp. Date</label>
              <select id="strikPriceAnalisisExpiryDate" class="select-style1">
                @php foreach($ExpiryDateFilter as $lprow){ @endphp
                  <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
                @php } @endphp
               </select>
            </select>
          </div>
        </div>
    @if(is_array(@$callsAnalysis))
        <div id="Calls" class="tab_content">
          <div class="scrollbar-inner" >
            <table class="table-style1 elm-dt-c-strike-price-analysis-data" style="height:500px; display: block;">
                <thead>
                    <tr>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
                     <th class="big-font">LTP</th>
                     <th class="big-font">LTP Change</th>
                     <th class="big-font">LTP Change%</th>
                     <th class="big-font">Traded Quantity</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">Open Int. Chg</th>
                     <th class="big-font">Open Int. Chg%</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array(@$callsAnalysis)){ 
                    foreach ($callsAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                    @endphp
                      <tr>
                       <td>{{date('d M Y', strtotime($rowObj['EXPDATE']))}}</td>
                       <td>{{@number_format(@$rowObj['STRIKEPRICE'],2) }}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['FaOdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['FaOchange'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Volume'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OPENINTEREST'],2)}}</td>
                       <td>{{@number_format(@$rowObj['DiffOpenInt'],2) }}</td>
                       <td>{{@number_format(@$rowObj['chgOpenInt'],2) }}</td>
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
    @endif
    @if(is_array(@$putsAnalysis))
        <div id="Puts" class="tab_content" style="height:500px">
          <div class="scrollbar-inner">
            <table class="table-style1 elm-dt-p-strike-price-analysis-data" style="height:500px; display: block;">
                <thead>
                    <tr>
                     <th class="big-font">Expiry</th>
                     <th class="big-font">Strike Price</th>
                     <th class="big-font">LTP</th>
                     <th class="big-font">LTP Change</th>
                     <th class="big-font">LTP Change%</th>
                     <th class="big-font">Traded Quantity</th>
                     <th class="big-font">Open Interest</th>
                     <th class="big-font">Open Int. Chg</th>
                     <th class="big-font">Open Int. Chg%</th>
                   </tr>
                </thead>
               <tbody>
 
                 @php
                  if(is_array(@$putsAnalysis)){ 
                    foreach ($putsAnalysis as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                    @endphp
                      <tr>
                       <td>{{date('d M Y', strtotime($rowObj['EXPDATE']))}}</td>
                       <td>{{@number_format(@$rowObj['STRIKEPRICE'],2) }}</td>
                       <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                       <td>{{@number_format(@$rowObj['FaOdiff'],2)}}</td>
                       <td>{{@number_format(@$rowObj['FaOchange'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Volume'],2)}}</td>
                       <td>{{@number_format(@$rowObj['OPENINTEREST'],2)}}</td>
                       <td>{{@number_format(@$rowObj['DiffOpenInt'],2) }}</td>
                       <td>{{@number_format(@$rowObj['chgOpenInt'],2) }}</td>
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
    @endif   
    </div>
</div>
