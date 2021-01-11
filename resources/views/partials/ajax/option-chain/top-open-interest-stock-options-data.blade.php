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
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#topInterestStockOptionCall" class="changeTOISFilter active" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionCall" data-expdate="{{@$ExpDate}}" data-otpfilter="{{@$Opt}}">CALL</a></li>
        <li class="nav-item"><a href="#topInterestStockOptionPut" class="changeTOISFilter" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionPut" data-expdate="{{@$ExpDate}}" data-otpfilter="{{@$Opt}}">PUT</a></li>
      </ul>
      <input type="hidden" id="top_i_s_o_section" value="{{$section}}" />
    </div>
    <!-- /.col-md-8 -->

    <div class="col-md-4 select-holder">
      <label>Exp. Date</label>
      <select id="topInterestStockOptionExpiryDate" class="select-style1">
        @php foreach($ExpiryDateFilter as $lprow){ @endphp
        <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
        @php } @endphp
      </select>
      <select id="topInterestStockOptionFilter" class="select-style1">
        <option value="HOI">Highest in OI</option>
        <option value="LOI">Lowest in OI</option>
      </select>
    </div>
    <!-- /.col-md-4 -->
  </div>
  <!-- /.row -->


  <div class="tab-content" id="myTabContent">

    <div id="topInterestStockOptionCall" class="tab-pane fade show active">
    <div class="table-responsive">
      <table class="table-bordered mb-0">
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
          if(is_array(@$cVol)){
          foreach ($cVol as $idxKey =>$rowObj){
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
          echo '<tr>
            <td colspan="2">No Record Found!</td>
          </tr>';
          }
          @endphp
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.tab-pane -->

    <div id="topInterestStockOptionPut" class="tab-pane fade">
    <div class="table-responsive">
      <table class="table-bordered mb-0">
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
          if(is_array(@$pVol)){
          foreach ($pVol as $idxKey =>$rowObj){
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
          echo '<tr>
            <td colspan="2">No Record Found!</td>
          </tr>';
          }
          @endphp
        </tbody>
      </table>
    </div>
    </div>
    <!-- /.tab-pane -->

    <div class="view-detail bt">
      <a href="{{site_url('option-chain/open-interest-stock-option')}}" target="_blank">Full Details
        <span class="arr-lis"> > </span></a>
    </div>

  </div>
  <!-- /.tab-content -->

</div>