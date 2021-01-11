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
    <div class="col-md-12">
      <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
        @if(is_array(@$callsAnalysis))
        <li class="nav-item"><a href="#OptAnalyCalls" class="active" role="tab" data-toggle="tab" aria-controls="OptAnalyCalls">CALL</a></li>
        @endif
        @if(is_array(@$putsAnalysis))
        <li class="nav-item"><a href="#OptAnalyPuts" role="tab" data-toggle="tab" aria-controls="OptAnalyCalls">PUT</a></li>
        @endif
      </ul>
    </div>
    <!-- /.col-md-12 -->
  </div>
  <!-- /.row -->


  <div class="tab-content" id="myTabContent">

    @if(is_array(@$callsAnalysis))
    <div id="OptAnalyCalls" class="tab-pane fade show active">
      <div class="table-responsive">
      <table class="table-bordered elm-vartival-table">
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
        <tbody>
          @php
          if(is_array($callsAnalysis)){
          foreach ($callsAnalysis as $idxKey =>$rowObj){
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
            <td colspan="10">No Record Found!
            </td>
          </tr>';
          }
          @endphp
        </tbody>
      </table>
      </div>
    </div>
    @endif

    @if(is_array(@$putsAnalysis))
    <div id="OptAnalyPuts" class="tab-pane fade">
    <div class="table-responsive">
      <table class="table-bordered elm-vartival-table">
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
          if(is_array($putsAnalysis)){
          foreach ($putsAnalysis as $idxKey =>$rowObj){
          $rowObj =(array) $rowObj;
          @endphp
          <tr>
            <td>{{@$rowObj['Symbol']}}</td>
            <td>{{date('d M Y', strtotime(@$rowObj['ExpDate']))}}</td>
            <td>{{@number_format(@$rowObj['Strikepice'],2)}}</td>
            <td>{{@number_format(@$rowObj['Ltp'],2)}}</td>
            <td>{{@number_format(@$rowObj['PrevLtp'],2)}}</td>
            <td>{{@number_format(@$rowObj['OI'],2) }}</td>
            <td>{{@number_format(@$rowObj['PrevOI'],2) }}</td>
            <td>{{@number_format(@$rowObj['OIdiff'],2) }}</td>
            <td>{{@number_format(@$rowObj['OIchg'],2)}}</td>
            <td>{{@number_format(@$rowObj['OIVAlue'],2)}}</td>
          </tr>
          @php
          }
          }else{
          echo '<tr>
            <td colspan="10">No Record Found!</td>
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