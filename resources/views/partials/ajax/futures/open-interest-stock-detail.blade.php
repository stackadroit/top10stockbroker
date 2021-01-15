<div class="section-companydetails section-padding">

  <div class="row">
    <div class="col-md-12">
      <h1 class="text-orange">{{@$get_detail_page['main_h1_title']}}</h1>
      <p>{{@$get_detail_page['main_para_content']}}</p>
    </div>
    <!--./col-md-12-->
  </div>
  <!-- /.row -->
</div>

<div class="section_corporateact bg-light section-padding">

  <div class="row">
    <div class="col-md-12">
      <h2 class="">{{@$get_detail_page['section_title']}}</h2>
      <p>{{$get_detail_page['section_content']}}</p>
    </div>
    <!--./col-md-12-->
  </div>
  <!-- /.row -->


  <div class="row tab-holder">
    <div class="col-md-6">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        <li class="nav-item"><a href="#topInterestStockOptionHighest" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionHighest" class="active changeTOISFilterDetails" data-expdate="{{$get_detail_page['ExpDate']}}" data-inst-name="{{$get_detail_page['InstName']}}" data-page-name="{{$get_detail_page['PageName']}}" data-expdate="{{$get_detail_page['ExpDate']}}" data-page-size="{{$get_detail_page['PageSize']}}">Highest</a></li>
        <li class="nav-item"><a href="#topInterestStockOptionLowest" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionLowest" class="changeTOISFilterDetails" data-expdate="{{$get_detail_page['ExpDate']}}" data-inst-name="{{$get_detail_page['InstName']}}" data-page-name="{{$get_detail_page['PageName']}}" data-expdate="{{$get_detail_page['ExpDate']}}" data-page-size="{{$get_detail_page['PageSize']}}">Lowest</a></li>
      </ul>
      <!-- /.tabs -->
    </div>
    <div class="col-md-6">
      <div class="select-holder">
        <label>Exp. Date</label>
        <select id="topInterestStockOptionInDetailExpiryDate" class="select-style1">
          @php foreach($get_detail_page['ExpiryDateFilter'] as $lprow){ @endphp
          <option {{($get_detail_page['ExpDate'] ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1 }}">{{$lprow->expdate}}</option>
          @php } @endphp
        </select>
      </div>
    </div>
  </div>



  <div class="tab-content" id="myTabContent">

    <div id="topInterestStockOptionHighest" class="tab-pane fade show active">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered">
          <thead>
            <tr>
              <th class="big-font">Symbol</th>
              <th class="big-font">Expiry</th>
              <!-- <th class="big-font">Strike Price</th> -->
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
            if(is_array(@$get_detail_page['hTableData'])){
            foreach ($get_detail_page['hTableData'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$get_detail_page['futuresSymbol'][@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol'] }}">{{@$rowObj['Symbol']}}</a>
                @php
                }else{
                echo @$rowObj['Symbol'];
                }
                @endphp
              </td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate'])) }}</td>
              <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) 
                        ?></td> -->
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
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
      @php if($get_detail_page['hTableTotalRow'] > $get_detail_page['PageSize']){ @endphp
      <div class="alm-btn-wrap" id="loadMoreWrap_HOI">
        <button class="alm-load-more-btn" id="loadMore_HOI" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['hTableTotalRow']}}">Load More</button>
      </div>
      @php } @endphp
    </div>

    <div id="topInterestStockOptionLowest" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered">
          <thead>
            <tr>
              <th class="big-font">Symbol</th>
              <th class="big-font">Expiry</th>
              <!-- <th class="big-font">Strike Price</th> -->
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
            if(is_array(@$get_detail_page['lTableData'])){
            foreach ($get_detail_page['lTableData'] as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$get_detail_page['futuresSymbol'][@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol'] }}">{{@$rowObj['Symbol']}}></a>
                @php
                }else{
                echo @$rowObj['Symbol'];
                }
                @endphp
              </td>
              <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
              <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) 
                        ?></td> -->
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
              </td>';
              }
              @endphp
          </tbody>
        </table>
      </div>
      @php if($get_detail_page['lTableTotalRow'] > $get_detail_page['PageSize']){ @endphp
      <div class="alm-btn-wrap" id="loadMoreWrap_LOI">
        <button class="alm-load-more-btn" id="loadMore_LOI" href="javascript:void(0);" data-page_no="1" data-total="{{$get_detail_page['lTableTotalRow'] }}">Load More</button>
      </div>
      @php } @endphp
    </div>

  </div>