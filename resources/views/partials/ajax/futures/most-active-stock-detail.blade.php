<div class="section-companydetails pb-5">


  <div class="row">
    <div class="col-md-12">
      <h1 class="text-orange">{{@$get_detail_page['main_section_title']}}</h1>
      <p>{{@$get_detail_page['main_section_content']}}</p>
    </div>
    <!--./col-md-12-->
  </div>
  <!-- /.row -->
</div>


<div class="section_corporateact pb-5">

  <div class="row">
    <div class="col-md-12">
      <h1 class="">{{@$get_detail_page['section_title']}}</h1>
      <p>{{@$get_detail_page['section_content']}}</p>
    </div>
    <!--./col-md-12-->
  </div>
  <!-- /.row -->

  <div class="row tab-holder">
    <div class="col-md-6">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li  class="nav-item"><a href="#mostActiveStockVolume" role="tab" data-toggle="tab" aria-controls="mostActiveStockVolume" class="active changeMASEDFilterInDetail" data-expdate="{{@$get_detail_page['ExpDate']}}" data-page-size="{{$get_detail_page['PageSize']}}" data-inst-name="{{$get_detail_page['InstName']}}">Volume</a></li>
        <li  class="nav-item"><a href="#mostActiveStockValue" role="tab" data-toggle="tab" aria-controls="mostActiveStockValue" class="changeMASEDFilterInDetail" data-expdate="{{@$get_detail_page['ExpDate']}}" data-page-size="{{$get_detail_page['PageSize']}}" data-inst-name="{{$get_detail_page['InstName']}}">Value</a></li>
        <li  class="nav-item"><a href="#mostActiveStockGainers" role="tab" data-toggle="tab" aria-controls="mostActiveStockGainers" class="changeMASEDFilterInDetail" data-expdate="{{@$get_detail_page['ExpDate']}}" data-page-size="{{$get_detail_page['PageSize']}}" data-inst-name="{{$get_detail_page['InstName']}}">Gainers</a></li>
      </ul>
    </div>
    <div class="col-md-6">
      <div class="select-holder">
        <label>Exp. Date</label>
        <select id="mostActiveStockInDetailExpiryDate" class="select-style1">
          @php foreach($get_detail_page['ExpiryDateFilter'] as $lprow){ @endphp
          <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
          @php } @endphp
        </select>
      </div>
    </div>
  </div>



  <div class="tab-content" id="myTabContent">


    <div id="mostActiveStockVolume" class="tab-pane fade show active">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 table-bordered mb-20">
          <thead>
            <tr>
              <th class="big-font">Symbol</th>
              <th class="big-font">Expiry</th>
              <!-- <th class="big-font">Strike Price</th> -->
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
            if(@$get_detail_page['volumeTableTotalRow']){
            foreach ($get_detail_page['volumeAnalysis'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$futuresSymbol[@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                @php
                }else{
                echo @$rowObj['Symbol'];
                }
                @endphp
              </td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) 
                        ?></td> -->
              <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
              <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
            </tr>
            @php
            }
            }else{
            echo '<tr>
              <td colspan="2">No Record Found!</td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
      @php if($get_detail_page['volumeTableTotalRow'] > $get_detail_page['PageSize']){ @endphp
      <div class="alm-btn-wrap text-center mt-3" id="loadMoreWrap_vol">
        <button class="alm-load-more-btn" id="loadMore_vol" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['volumeTableTotalRow']}}">Load More</button>
      </div>
      @php } @endphp
    </div>

    <div id="mostActiveStockValue" class="tab-pane">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 table-bordered mb-20">
          <thead>
            <tr>
              <th class="big-font">Symbol</th>
              <th class="big-font">Expiry</th>
              <!-- <th class="big-font">Strike Price</th> -->
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
            if(@$get_detail_page['valueTableTotalRow']){
            foreach ($get_detail_page['valueAnalysis'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$futuresSymbol[@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                @php
                }else{
                echo @$rowObj['Symbol'];
                }
                @endphp
              </td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) 
                        ?></td> -->
              <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
              <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
            </tr>
            @php
            }
            }else{
            echo '<tr>
              <td colspan="2">No Record Found!</td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
      @php if(@$get_detail_page['valueTableTotalRow'] > $PageSize){ @endphp
      <div class="alm-btn-wrap text-center mt-3" id="loadMoreWrap_val">
        <button class="alm-load-more-btn" id="loadMore_val" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['valueTableTotalRow']}}">Load More</button>
      </div>
      @php } @endphp
    </div>

    <div id="mostActiveStockGainers" class="tab-pane">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 table-bordered mb-20">
          <thead>
            <tr>
              <th class="big-font">Symbol</th>
              <th class="big-font">Expiry</th>
              <!-- <th class="big-font">Strike Price</th> -->
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
            if(@$get_detail_page['gainerTableTotalRow']){
            foreach ($get_detail_page['gainerAnalysis'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$futuresSymbol[@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol']}}</a>
                @php
                }else{
                echo @$rowObj['Symbol'];
                }
                @endphp
              </td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <!-- <td><?php //echo @number_format(@$rowObj['StrikePrice'],2) 
                        ?></td> -->
              <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIValue'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2) }}</td>
              <td>{{@number_format(@$rowObj['Qty'],2)}}</td>
            </tr>
            @php
            }
            }else{
            echo '<tr>
              <td colspan="2">No Record Found!</td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
      @php if(@$get_detail_page['gainerTableTotalRow'] >$PageSize ) { @endphp
      <div class="alm-btn-wrap text-center mt-3" id="loadMoreWrap_G">
        <button class="alm-load-more-btn" id="loadMore_G" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['gainerTableTotalRow']}}">Load More</button>
      </div>
      @php } @endphp
    </div>


  </div>

</div>