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
    <div class="col-md-6">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#mostActiveOptionCall" role="tab" data-toggle="tab" aria-controls="mostActiveOptionCall" class="mostActiveOptionFilterTab active" data-opt-filter="vol">CALL</a></li>
        <li class="nav-item"><a href="#mostActiveOptionPut" role="tab" data-toggle="tab" aria-controls="mostActiveOptionPut" class="mostActiveOptionFilterTab" data-opt-filter="vol">PUT</a></li>
      </ul>
    </div>
    <!-- /.col-md-6 -->
    <div class="col-md-6">
      <div class="select-holder">
        <select id="mostActiveOptionFilter" class="select-style1">
          <option value="vol">Volume</option>
          <option value="val">Value</option>
          <option value="G">Gainers</option>
          <option value="L">Losers</option>
        </select>
      </div>
    </div>
    <!-- /.col-md-6  -->
  </div>
  <!-- /.row -->

  <div class="tab-content" id="myTabContent">

    @if(is_array(@$cVol))
    <div id="mostActiveOptionCall" class="tab-pane fade show active">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered">
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
              <td>{{@$rowObj['Symbol']}}</td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <td>{{@number_format(@$rowObj['StrikePrice'],2)}}</td>
              <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
              <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
            </tr>
            @php
            }
            }else{
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>
            </tr>';
            }
            @endphp
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.tab-pane -->
    @endif

    @if(is_array(@$pVol))
    <div id="mostActiveOptionPut" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered">
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
              <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
              <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
            </tr>
            @php
            }
            }else{
            echo '<tr>
              <td colspan="2">No Record Found!
              </td>
            </tr>';
            }
            @endphp
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.tab-pane -->
    @endif
  </div>
  <!-- /.tab-content -->

</div>