@php 
if(is_array($peersComparison)) { 
@endphp
<div class="section_peersComp pb-5">
    <div class="inner-wrap">

        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <!-- /.section-head -->

        <div class="peers_table table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false">
            <table class="table-bordered">
                <thead>
                    <tr style="font-size: 12px;">
                        <th width="25%"></th>
                        <th width="25%">CLOSE</th>
                        <th class="text-center">PREV CLOSE</th>
                        <th class="text-center">CHANGE</th>
                        <th class="text-center">CHANGE (%)</th>
                        <th class="text-center">VOLUME</th>
                        <th class="text-center">52WEEKHIGH</th>
                        <th class="text-center">52WEEKLOW</th>
                        <th class="text-center">NETSALES (Rs. in Million)</th>
                        <th class="text-center">NETPROFIT (Rs. in Million)</th>
                        <th class="text-center">MCAP</th>
                        <th class="text-center">EPSc</th>
                        <th class="text-center">PE</th>
                    </tr>
                </thead>
                <tbody> 
                @php 
                    $ipc =0;
                  foreach ($peersComparison as $key => $rowArray) {
                    $rowObj = (array) $rowArray;
                   @endphp
                    <tr>
                        <td class="big-font">
                           @if($ipc)
                              <a href="{{site_url('/') .$acc_companyLists[@$rowObj['FINCODE']]}}" title="{{@$rowObj['SNAME']}}"> 
                                {{@$rowObj['SNAME']}}
                            </a>
                        @else
                            {{@$rowObj['SNAME']}}
                        @endif 
                          </td>
                        <td class="text-center">{{@number_format(@$rowObj['CLOSE'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['PREV_CLOSE'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['CHANGE'],2)}}</td>                 
                        <td class="text-center">
                          @if(@$rowObj['PER_CHANGE']>0)  
                          <span class="text-green">{{@$rowObj['PER_CHANGE']}}</span>
                          @else
                          <span class="text-red">{{@$rowObj['PER_CHANGE']}}</span>
                          @endif
                          </td>
                        <td class="text-center">{{@number_format(@$rowObj['VOLUME'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['52WEEKHIGH'],2)}}</td>                 
                        <td class="text-center">{{@number_format(@$rowObj['52WEEKLOW'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['NETSALES'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['NETPROFIT'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['MCAP'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['EPSc'],2)}}</td>
                        <td class="text-center">{{@number_format(@$rowObj['PE'],2)}}</td>
                    </tr>
                    @php
                    $ipc++;
                  } 
                  @endphp                                        
               </tbody>
            </table>
        </div>
        <!-- /.peers_table -->

    </div>
    <!-- /.inner -->
</div>
<!-- /.section_peersComp -->
@php } @endphp