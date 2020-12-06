<div class="section_history bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <!-- /.section-head -->

        <div class="history_table  scrollbar-inner" style="overflow-x: auto; ">
            <table class="table-style1 th-border">
                <thead>
                    <tr>
                        <th width="35%"></th>
                        <th>
                            <select id="history_period_box_filter" name="period_box_bse" class="select-style1">
                                <option value="1W" class=""{{ ($historyFilter  =='1w'?'selected="selected"':'')}}>1 week</option>
                                <option value="1M" class="" {{ ($historyFilter  =='1M'?'selected="selected"':'')}}>1 month</option>
                                <option value="3M" class="" {{ ($historyFilter  =='3M'?'selected="selected"':'') }}>3 months</option>
                                <option value="6M" class="" {{ ($historyFilter  =='6M'?'selected="selected"':'') }}>6 months</option>
                                <option value="1Y" class="" {{ ($historyFilter  =='1Y'?'selected="selected"':'') }}>1 year</option>
                                <option value="3Y" class="" {{ ($historyFilter  =='3Y'?'selected="selected"':'') }}>3 year</option>
                                <option value="5Y" class="" {{ ($historyFilter  =='5Y'?'selected="selected"':'')}}>5 year</option>
                            </select>
                        </th>
                        <th>Current Price</th>
                        <th>%Gain / Loss</th>
                    </tr>
                </thead>
                <tbody id="history-price-wrap">  
                  @php
                    if($historyPrice){
                      foreach ($historyPrice as $key => $rowArray) {
                      @endphp
                          <tr>
                            <td><span class="fn_semibold">
                              {{$rowArray['label']}} </span></td>
                            <td>{{$rowArray['old_price']}}</td>
                            <td>{{$rowArray['current_price']}}</td>
                            <td>
                              
                               @php if($rowArray['avg_pre'] >0) {
                                  echo '<div class="bggreen_tbl">'.$rowArray['avg_pre'] .'</div>';
                                }else{
                                  echo '<div class="bgred_tbl">'.$rowArray['avg_pre'] .'</div>';
                                }  
                                @endphp
                            </td>
                        </tr>
                        @php
                      }
                    }
                 @endphp                        
                </tbody>
            </table>
            <!-- table -->
        </div>
        <!-- /.history_table -->
    </div>
    <!-- /.inner-wrap -->
</div>
<!-- /.section_history -->
