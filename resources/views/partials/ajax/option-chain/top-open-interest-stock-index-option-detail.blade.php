<div class="section-companydetails pb-5">
  <div class="row">
    <div class="col-md-12">
      <h1 class="text-orange">{{@$get_detail_page['main_h1_title']}}</h1>
      <p>{{@$get_detail_page['main_para_content']}}</p>
    </div>
    <!-- /.col-md-12 -->
  </div>
  <!-- /.row -->
</div>



<div class="section_corporateact pb-5">

  <div class="row">
    <div class="col-md-12">
      <h2 class="">{{@$get_detail_page['section_title']}}</h2>
      <p>{{@$get_detail_page['section_content']}}</p>
    </div>
    <!-- /.col-md-12 -->
  </div>
  <!-- /.row -->


  <div class="row tab-holder">
    <div class="col-md-6">
      <input type="hidden" id="ActiveInstName" value="{{@$get_detail_page['InstName']}}">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#topInterestStockIndexOptionCall" class="changeTOISIFilter active" role="tab" data-toggle="topInterestStockIndexOptionCall" aria-controls="Calls" data-expdate="{{@$get_detail_page['ExpDate']}}" data-otpfilter="{{@$get_detail_page['Opt']}}">CALL</a></li>
        <li class="nav-item"><a href="#topInterestStockIndexOptionPut" class="changeTOISIFilter" role="tab" data-toggle="tab" aria-controls="topInterestStockIndexOptionPut" data-expdate="{{@$get_detail_page['ExpDate']}}" data-otpfilter="{{@$get_detail_page['Opt']}}">PUT</a></li>
      </ul>
    </div>
    <!-- /.col-md-6 -->
    <div class="col-md-6">
      <div class="select-holder">
        <label>Exp. Date</label>
        <select id="topInterestStockIndexOptionExpiryDate" class="select-style1">
          @php foreach($get_detail_page['ExpiryDateFilter'] as $lprow){ @endphp
          <option {{($get_detail_page['ExpDate'] ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
          @php } @endphp
        </select>
        </select>

        <select id="topInterestStockIndexOptionFilter" class="select-style1">
          <option value="HOI">Highest in OI</option>
          <option value="LOI">Lowest in OI</option>
        </select>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
  <!-- /.row -->


  <div class="tab-content" id="myTabContent">

    <div id="topInterestStockIndexOptionCall" class="tab-pane fade show active">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
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
            if(is_array($get_detail_page['cVol'])){
            foreach ($get_detail_page['cVol'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>{{@$rowObj['Symbol']}}</td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <td>{{@number_format(@$rowObj['Strikepice'],2) }}</td>
              <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevOI'],2) }}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
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
        <div class="alm-btn-wrap" id="loadMoreWrapCE">
          <button class="alm-load-more-btn" id="loadMoreCE" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['ctableTotalRow']}}">Load More</button>
        </div>
      </div>
    </div>
    <!-- /.tab-pane -->

    <div id="topInterestStockIndexOptionPut" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
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
            if(is_array(@$get_detail_page['pVol'])){
            foreach ($get_detail_page['pVol'] as $idxKey =>$rowObj){
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
              <td colspan="2">No Record Found!
              </td>
            </tr>';
            }
            @endphp
          </tbody>
        </table>
        <div class="alm-btn-wrap" id="loadMoreWrapPE">
          <button class="alm-load-more-btn" id="loadMorePE" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['ptableTotalRow']}}">Load More</button>
        </div>
      </div>
    </div>
    <!-- /.tab-pane -->

  </div>
  <!-- /.tab-content -->

</div>