
<div class="section_corporateact bg-light section-padding">
    <div class="inner-wrap">

        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
          </div>
        <!-- /.section-head -->

        <ul class="tabs commn_tabs">
            <li><a href="#bm">Board Meetings</a></li>
            <li><a href="#bonus">Bonus</a></li>
            <li><a href="#split">Splits</a></li>
            <li><a href="#rights">Rights</a></li>
            <li><a href="#agm">AGM/EGM</a></li>
        </ul>
        <!-- /.tabs -->

        <div id="bm" class="tab_content">
            <table class="table-style1">
                <thead>
                    <tr>
                     <th class="big-font">Date</th>
                     <th class="big-font">Details</th>
                   </tr>
                </thead>
               <tbody>
                  @php
                  if(is_array($caBrandMeetingResponse)){ 
                    foreach ($caBrandMeetingResponse as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                    @endphp
                      <tr>
                       <td>{{@$rowObj['Source Date']}}</td>
                       <td>{{@$rowObj['Details']}}</td>
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
        <!-- /.tab_content -->
        <div id="bonus" class="tab_content">
            <table class="table-style1">
                <thead>
                    <tr>
                     <th class="big-font">Date</th>
                     <th class="big-font">Details</th>
                   </tr>
                </thead>
               <tbody>
                @php 
                  if(is_array($caBonusResponse)){
                    foreach ($caBonusResponse as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      if(is_array($rowObj) && count($rowObj)) {
                        @endphp
                        <tr>
                         <td>
                         @if(@$rowObj['ex_date'])
                          {{date('d M Y',strtotime(@$rowObj['ex_date']))}} 
                         @endif
                       </td>
                         <td>{{(@$rowObj['Details'])?@$rowObj['Details']:'-'}}</td>
                        </tr>
                       @php
                        }
                      }
                    }else{
                    echo '<tr><td colspan="2">No Record Found!</div>';
                  }
                  @endphp
                  </tbody>
            </table>
        </div>      
        <!-- /.tab_content -->
        <div id="split" class="tab_content">
            <table class="table-style1">
                <thead>
                    <tr>
                     <th class="big-font">NSE Date</th>
                     <th class="big-font">BSE Date</th>
                     <th class="big-font">Current Face Value</th>
                     <th class="big-font">New Face Value</th>
                   </tr>
                </thead>
               <tbody>
                @php 
                  if(is_array($caSplitResponse)){
                    foreach (@$caSplitResponse as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      if(is_array($rowObj) && count($rowObj)) {
                       @endphp
                         <tr>
                         <td>
                            @if(@$rowObj['nse_date'])
                            {{date('d M Y',strtotime(@$rowObj['nse_date']))
                          }}
                           @endif
                       </td>
                         <td>
                            @if(@$rowObj['bse_date'])
                            {{date('d M Y',strtotime(@$rowObj['bse_date']))}}
                           @endif
                         </td>
                         <td>{{(@$rowObj['CurrentFV'])?@$rowObj['CurrentFV']:'-'}}</td>
                         <td>{{(@$rowObj['NewFV'])?@$rowObj['NewFV']:'-' }}</td>
                        </tr>
                        @php
                      }
                    }
                  }else{
                    echo '<tr><td colspan="2">No Record Found!</div>';
                  }
                  @endphp
               </tbody>
            </table>
        </div>      
        <!-- /.tab_content -->
        <div id="rights" class="tab_content">
            <table class="table-style1">
                <thead>
                    <tr>
                     <th class="big-font" style="width:200px;">Date</th>
                     <th class="big-font">Details</th>
                   </tr>
                </thead>
               <tbody>
                @php 
                  if(is_array($caRightResponse)){
                    foreach ($caRightResponse as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      if(is_array($rowObj) && count($rowObj)) {
                       @endphp
                        <tr>
                         <td style="width:200px;">@if(@$rowObj['ex_date'])
                          {{date('d M Y',strtotime(@$rowObj['ex_date']))}}
                        @endif
                      </td>
                         <td>{{(@$rowObj['Details'])?@$rowObj['Details']:'-'}}</td>
                        </tr>
                        @php
                      }
                    }
                  }else{
                    echo '<tr><td colspan="2">No Record Found!</div>';
                  }
                  @endphp
               </tbody>
            </table>
        </div>      
        <div id="agm" class="tab_content">
            <table class="table-style1">
                <thead>
                    <tr>
                     <th class="big-font">Date</th>
                     <th class="big-font">Ex-Dividend date</th>
                   </tr>
                </thead>
               <tbody>
                  @php 
                  if(is_array($caAGMResponse)){
                    foreach ($caAGMResponse as $idxKey =>$rowObj){
                      $rowObj =(array) $rowObj;
                      if(is_array($rowObj) && count($rowObj)) {
                      @endphp
                        <tr>
                           <td>{{@$rowObj['Source Date']}}</td>
                           <td>{{@$rowObj['Details']}}</td>
                        </tr>
                        @php
                      }
                    }
                  }else{
                    echo '<tr><td colspan="2">No Record Found!</div>';
                  }
                  @endphp
               </tbody>
            </table>
        </div>
    </div>
</div>
