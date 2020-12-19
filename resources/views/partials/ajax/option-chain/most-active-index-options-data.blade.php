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
      <input type="hidden" value="{{$section}}" id="most_a_i_o_section">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#mostActiveIndexOptionCall" class="changeMAIOFilter active" role="tab" data-toggle="tab" aria-controls="mostActiveIndexOptionCall" data-expdate="{{@$ExpDate}}" data-rtypefilter="{{@$Rtype}}">CALL</a></li>
        <li class="nav-item"><a href="#mostActiveIndexOptionPut" class="changeMAIOFilter" role="tab" data-toggle="tab" aria-controls="mostActiveIndexOptionPut" aria-controls="mostActiveIndexOptionPut" data-expdate="{{@$ExpDate}}" data-rtypefilter="{{@$Rtype}}">PUT</a></li>
      </ul>
    </div>
    <!-- /.col-md-8 -->

    <div class="col-md-4 select-holder">
      <label>Exp. Date</label>
      <select id="mostActiveIndexOptionExpiryDate" class="select-style1">
        @php foreach($ExpiryDateFilter as $lprow){ @endphp
        <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
        @php } @endphp
      </select>
      <select id="mostActiveIndexOptionFilter" class="select-style1">
        <option value="vol">Volume</option>
        <option value="val">Value</option>
        <option value="G">Gainers</option>
        <option value="L">Losers</option>
      </select>
    </div>
    <!-- /.col-md-4 -->

  </div>
  <!-- row -->

  <div class="tab-content" id="myTabContent">

    <div id="mostActiveIndexOptionCall" class="tab-pane fade show active">
      <table class="table-responsive-md table-bordered mb-0">
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
            <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
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
    <!-- /.tab-pane -->

    <div id="mostActiveIndexOptionPut" class="tab-pane fade">
        <table class="table-responsive-md table-bordered mb-0">
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
              <td>{{@number_format(@$rowObj['OI'],2) }}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2) }}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
              <td>{{@number_format(@$rowObj['Qty'],2) }}</td>
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
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->

    <div class="view-detail bt">
      <a href="{{site_url('option-chain/most-active-index-option')}}" target="_blank">Full Details
        <span class="arr-lis"> > </span>
      </a>
    </div>

  </div>