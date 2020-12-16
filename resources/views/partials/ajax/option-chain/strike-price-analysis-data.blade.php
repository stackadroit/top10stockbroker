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
              @if(is_array(@$callsAnalysis))
                <li class="nav-item" role="presentation"><a href="#Calls"  class="changeSPAFilter active" role="tab" data-toggle="tab" aria-controls="Calls" data-expdate="{{@$ExpDate}}">CALL</a></li>
              @endif
              @if(is_array(@$putsAnalysis))
                  <li class="nav-item"  role="presentation"><a href="#Puts" class="changeSPAFilter" role="tab" data-toggle="tab" aria-controls="Puts" data-expdate="{{@$ExpDate}}">PUT</a></li>
              @endif
          </ul>
        </div>
        <!-- /.col-md-9 -->

        <div class="col-md-4 select-holder">
          <label>Exp. Date</label>
            <select id="strikPriceAnalisisExpiryDate" class="select-style1">
              @php foreach($ExpiryDateFilter as $lprow){ @endphp
                <option {{($ExpDate ==$lprow->expdate1)?'selected="selected"':''}} value="{{$lprow->expdate1}}">{{$lprow->expdate}}</option>
              @php } @endphp
              </select>
        </div>
        <!-- /.col-md-3 -->
        
      </div>
      <!-- /.row -->

      <div class="tab-content" id="myTabContent">
        @if(is_array(@$callsAnalysis))
            <div id="Calls" class="tab-pane fade show active" role="tabpanel">
              <table class="table-responsive-md table-bordered elm-dt-c-strike-price-analysis-data">
                  <thead class="table-dark">
                      <tr>
                      <th class="big-font">Expiry</th>
                      <th class="big-font">Strike Price</th>
                      <th class="big-font">LTP</th>
                      <th class="big-font">LTP Change</th>
                      <th class="big-font">LTP Change%</th>
                      <th class="big-font">Traded Quantity</th>
                      <th class="big-font">Open Interest</th>
                      <th class="big-font">Open Int. Chg</th>
                      <th class="big-font">Open Int. Chg%</th>
                    </tr>
                  </thead>
                <tbody>
                    @php
                    if(is_array(@$callsAnalysis)){ 
                      foreach ($callsAnalysis as $idxKey =>$rowObj){
                        $rowObj =(array) $rowObj;
                      @endphp
                        <tr>
                        <td>{{date('d M Y', strtotime($rowObj['EXPDATE']))}}</td>
                        <td>{{@number_format(@$rowObj['STRIKEPRICE'],2) }}</td>
                        <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                        <td>{{@number_format(@$rowObj['FaOdiff'],2)}}</td>
                        <td>{{@number_format(@$rowObj['FaOchange'],2)}}</td>
                        <td>{{@number_format(@$rowObj['Volume'],2)}}</td>
                        <td>{{@number_format(@$rowObj['OPENINTEREST'],2)}}</td>
                        <td>{{@number_format(@$rowObj['DiffOpenInt'],2) }}</td>
                        <td>{{@number_format(@$rowObj['chgOpenInt'],2) }}</td>
                      </tr>
                      @php
                        }
                      }else{
                        echo '<tr><td colspan="2">No Record Found!</div>';
                      }
                    @endphp
                  </tbody>
              </table>
          </div> 
          <!-- /.tab-pane -->
        @endif
        @if(is_array(@$putsAnalysis))
            <div id="Puts" class="tab-pane fade" role="tabpanel">
              <table class="table-responsive-md table-bordered elm-dt-p-strike-price-analysis-data">
                  <thead>
                      <tr>
                      <th class="big-font">Expiry</th>
                      <th class="big-font">Strike Price</th>
                      <th class="big-font">LTP</th>
                      <th class="big-font">LTP Change</th>
                      <th class="big-font">LTP Change%</th>
                      <th class="big-font">Traded Quantity</th>
                      <th class="big-font">Open Interest</th>
                      <th class="big-font">Open Int. Chg</th>
                      <th class="big-font">Open Int. Chg%</th>
                    </tr>
                  </thead>
                <tbody>

                  @php
                    if(is_array(@$putsAnalysis)){ 
                      foreach ($putsAnalysis as $idxKey =>$rowObj){
                        $rowObj =(array) $rowObj;
                      @endphp
                        <tr>
                        <td>{{date('d M Y', strtotime($rowObj['EXPDATE']))}}</td>
                        <td>{{@number_format(@$rowObj['STRIKEPRICE'],2) }}</td>
                        <td>{{@number_format(@$rowObj['LTP'],2)}}</td>
                        <td>{{@number_format(@$rowObj['FaOdiff'],2)}}</td>
                        <td>{{@number_format(@$rowObj['FaOchange'],2)}}</td>
                        <td>{{@number_format(@$rowObj['Volume'],2)}}</td>
                        <td>{{@number_format(@$rowObj['OPENINTEREST'],2)}}</td>
                        <td>{{@number_format(@$rowObj['DiffOpenInt'],2) }}</td>
                        <td>{{@number_format(@$rowObj['chgOpenInt'],2) }}</td>
                      </tr>
                      @php
                        }
                      }else{
                        echo '<tr><td colspan="2">No Record Found!</div>';
                      }
                    @endphp
                  </tbody>
              </table>
            </div> 
            <!-- /.tab-pane -->
        @endif   
      </div>
      <!-- /.tab-content -->

</div>
