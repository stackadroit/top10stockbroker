<div class="section_corporateact pb-5">


  <div class="row">
    <div class="col-md-12">
      <h2 class="">{{@$section_title}}</h2>
      <p>{{@$section_content}}</p>
      <!--./col-md-12-->
    </div>
  </div>
  <!-- /.row -->


  <div class="row tab-holder">
    <div class="col-md-12">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#bm" class="active" role="tab" data-toggle="tab" aria-controls="bm">Board Meetings</a></li>
        <li class="nav-item"><a href="#bonus" role="tab" data-toggle="tab" aria-controls="bonus">Bonus</a></li>
        <li class="nav-item"><a href="#split" role="tab" data-toggle="tab" aria-controls="split">Splits</a></li>
        <li class="nav-item"><a href="#rights" role="tab" data-toggle="tab" aria-controls="rights">Rights</a></li>
        <li class="nav-item"><a href="#agm" role="tab" data-toggle="tab" aria-controls="agm">AGM/EGM</a></li>
      </ul>
      <!-- /.tabs -->
    </div>
    <!-- /.col-md-12 -->
  </div>
  <!-- /.row -->



  <div class="tab-content" id="myTabContent">


    <div id="bm" class="tab-pane fade show active">
      <div class="table-responsive">
        <table class="table-style1 table-bordered">
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
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
    </div>


    <div id="bonus" class="tab-pane fade">
      <div class="table-responsive">
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
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
    </div>


    <div id="split" class="tab-pane fade">
      <div class="table-responsive">
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
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
    </div>


    <div id="rights" class="tab-pane fade">
      <div class="table-responsive">
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
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
    </div>

    <div id="agm" class="tab-pane fade">
      <div class="table-responsive">
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
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>