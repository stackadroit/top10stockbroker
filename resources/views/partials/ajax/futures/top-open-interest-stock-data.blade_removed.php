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
        <li class="nav-item"><a href="#topInterestStockOptionHighest" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionHighest" class="active changeTOISFilter" data-expdate="{{@$ExpDate}}">Highest</a></li>
        <li class="nav-item"><a href="#topInterestStockOptionLowest" role="tab" data-toggle="tab" aria-controls="topInterestStockOptionLowest" class="changeTOISFilter" data-expdate="{{@$ExpDate}}">Lowest</a></li>
      </ul>
      <!-- /.tabs -->
    </div>
    <div class="col-md-6">
      <div class="select-holder">
        <label>Exp. Date</label>
        <select id="topInterestStockOptionExpiryDate" class="select-style1">
          @php foreach($ExpiryDateFilter as $lprow){ @endphp
          <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':'' }} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
          @php } @endphp
        </select>

      </div>
    </div>
  </div>


  <div class="tab-content" id="myTabContent">

    <div id="topInterestStockOptionHighest" class="tab-pane fade show active">
      <div class="table-responsive  tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered mb-0">
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
            if(is_array(@$hTableData)){
            foreach ($hTableData as $idxKey =>$rowObj){
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
              <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) 
                        ?></td> -->
              <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevOI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
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
    </div>


    <div id="topInterestStockOptionLowest" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-bordered mb-0">
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
            if(is_array(@$lTableData)){
            foreach ($lTableData as $idxKey =>$rowObj){
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
              <!-- <td><?php //echo @number_format(@$rowObj['Strikepice'],2) 
                        ?></td> -->
              <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
              <td>{{@number_format(@$rowObj['OI'],2)}}</td>
              <td>{{@number_format(@$rowObj['PrevOI'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['OIchg'],2) }}</td>
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
    </div>

    <div class="view-detail bt">
      <a href="{{site_url('futures/open-interest-stock-futures')}}" target="_blank">Full Details
        <span class="arr-lis"> > </span>
      </a>
    </div>

  </div>
</div>