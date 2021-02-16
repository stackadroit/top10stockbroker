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
        <li class="nav-item"><a href="#mostActiveStockVolume" role="tab" data-toggle="tab" aria-controls="mostActiveStockVolume" class="active changeMASEDFilter" data-expdate="{{@$ExpDate}}">Volume</a></li>
        <li class="nav-item"><a href="#mostActiveStockValue" role="tab" data-toggle="tab" aria-controls="mostActiveStockValue" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Value</a></li>
        <li class="nav-item"><a href="#mostActiveStockGainers" role="tab" data-toggle="tab" aria-controls="mostActiveStockGainers" class="changeMASEDFilter" data-expdate="{{@$ExpDate}}">Gainers</a></li>
      </ul>
    </div>
    <div class="col-md-6">
      <div class="select-holder">
        <label>Exp. Date</label>
        <select id="mostActiveStockExpiryDate" class="select-style1">
          @php
          foreach($ExpiryDateFilter as $lprow){ @endphp
          <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
          @php } @endphp
        </select>
      </div>
    </div>
  </div>

  <div class="tab-content" id="myTabContent">

    <div id="mostActiveStockVolume" class="tab-pane fade show active">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 mb-0">
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
            if(is_array($callsAnalysis)){
            foreach ($callsAnalysis as $idxKey =>$rowObj){
            $rowObj =(array) $rowObj;
            @endphp
            <tr>
              <td>
                @php
                $smId =@$futuresSymbol[@$rowObj['Symbol']];
                if(@$smId){
                $smbLink =get_the_permalink($smId);
                @endphp
                <a href="{{@$smbLink}}" title="{{@$rowObj['Symbol']}}">{{@$rowObj['Symbol'] }}</a>
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
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
    </div>

    <div id="mostActiveStockValue" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 mb-0">
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
            if(is_array($putsAnalysis)){
            foreach ($putsAnalysis as $idxKey =>$rowObj){
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
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
    </div>

    <div id="mostActiveStockGainers" class="tab-pane fade">
      <div class="table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
        <table class="table-style1 mb-0">
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
            if(is_array($gainerAnalysis)){
            foreach ($gainerAnalysis as $idxKey =>$rowObj){
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
              <td>{{@number_format(@$rowObj['OIdiff'],2)}}</td>
              <td>{{@number_format(@$rowObj['Oichg'],2)}}</td>
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
    </div>

    <div class="view-detail bt">
      <a href="{{site_url('futures/most-active-stock-futures')}}" target="_blank">Full Details
        <span class="arr-lis"> > </span>
      </a>
    </div>

  </div>

</div>