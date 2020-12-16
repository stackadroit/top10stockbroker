<div class="section_corporateact pb-5">

  <div class="row">
    <div class="col-md-12">
      <h2 class="">{{@$section_title}}</h2>
      <p>{{@$section_content}}</p>
    </div>
    <!--./col-md-12-->
  </div>
  <!-- /.row -->

  <div class="row tab-holder">
    <div class="col-md-8">
      <input type="hidden" id="SIsection" value="{{$section}}">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#stocksPutCallRatios" class="changeSIFilter active" role="tab" data-toggle="tab" aria-controls="stocksPutCallRatios" data-expdate="{{@$SExpDate}}" data-reporttype="{{@$ReportType}}">Stocks</a></li>
        <li class="nav-item"><a href="#indexesPutCallRatios" class="changeSIFilter" role="tab" data-toggle="tab" aria-controls="indexesPutCallRatios" data-expdate="{{@$IExpDate}}" data-reporttype="{{@$ReportType}}">Indexes</a></li>
      </ul>
    </div>
    <!-- /.col-md-8 -->

    <div class="col-md-4">
      <div id="stk-filter" class="select-holder">
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

      <div id="idx-filter" class="select-holder" style="display: none">
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
    <!-- /.col-md-4 -->

  </div>
  <!-- /.row -->


  <div class="tab-content" id="myTabContent">
    @if(is_array(@$stockCPAnalysis))
    <div id="stocksPutCallRatios" class="tab-pane fade show active">
      <table class="table-responsive-md table-bordered elm-vartival-table mb-0">
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
              <a href="{{$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
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
          echo '<tr>
            <td colspan="10">No Record Found!
            </td>
          </tr>';
          }
          @endphp
        </tbody>
      </table>
    </div>
    <!-- /.tab-pane -->
    @endif

    @if(is_array(@$indexCPAnalysis))
    <div id="indexesPutCallRatios" class="tab-pane fade ">
      <table class="table-responsive-md table-bordered elm-vartival-table mb-0">
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
              <a href="{{$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
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
          echo '<tr>
            <td colspan="10">No Record Found!
            </td>
          </tr>';
          }
          @endphp
        </tbody>
      </table>
    </div>
    <!-- /.tab-pane -->
    @endif


  </div>
  <!-- /.tab-content -->



  <div class="view-detail bt">
    <a href="{{site_url('option-chain/put-call-ratio/')}}" target="_blank">Full Details
      <span class="arr-lis"> > </span>
    </a>
  </div>



</div>