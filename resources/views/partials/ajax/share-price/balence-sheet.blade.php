@if(@$balenceResposeArray)
<div class="section_balanceSheet bg-light section-padding">
    <div class="inner-wrap">
        <div class="section-head">  
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        
        <div class="balnce_table scrollbar-inner">
            <table class="table-style1 th-border">
               <thead>
                  <tr>
                     <th></th>
                     @php 
                     foreach ($balenceResposeArray as $key => $value) {
                        if($key ==0){
                          $arrIndex =(array) $value;
                          foreach ($arrIndex as $inrkey => $inrvalue) {
                           if($inrkey != 'Particulars'){
                            @endphp
                            <th class="text-center">{{$inrkey}}<br>(<span style="font-size:13px"><span class="icon-rupees_1"></span>Rs. in Million</span>) </th>
                            @php 
                            }
                          }
                        }
                        break;
                     }
                      @endphp
                  </tr>
               </thead>
               <tbody>
                  @php 
                  if($sector =='Bank'){
                    $getRows =array('Share Capital','Total Reserves',
                      'Deposits',
                      'Borrowings',
                      'Other Liabilities & Provisions',
                      'Total Liabilities',
                      'Cash and balance with Reserve Bank of India',
                      'Balances with banks and money at call',
                      'Investments',
                      'Advances',
                      'Total Debt',
                      'Net Block',
                      'Other Assets',
                      'Total Assets',
                      'Contingent Liabilities',
                      'Bills for collection',
                      'Book Value',
                      'Adjusted Book Value',
                    );
                  }else{
                    $getRows =array('Share Capital','Total Reserves',
                      'Total Non-Current Liabilities',
                      'Total Current Liabilities',
                      'Total Liabilities',
                      'Total Non-Current Assets',
                      'Total Current Assets',
                      'Total Assets',
                      'Contingent Liabilities',
                      'Total Debt',
                      'Book Value',
                      'Adjusted Book Value',
                    );
                  }
                    $totalCal1 =0;
                    $totalCal2 =0;
                    $totalCal3 =0;
                    $totalCal1Past =0;
                    $totalCal2Past =0;
                    $totalCal3Past =0;
                     foreach ($balenceResposeArray as $key => $value) {
                        if($key !=0){
                          $arrIndex =(array) $value;
                          $reqIdx= str_replace('&nbsp;','',trim($arrIndex['Particulars']));
                          if($sector =='Bank'){
                            if($reqIdx == 'Cash and balance with Reserve Bank of India'){
                                  $totalCal1 =$arrIndex['Mar2019'];
                                  $totalCal1Past =$arrIndex['Mar2018'];
                            }
                            if($reqIdx == 'Advances'){
                                  $totalCal2 =$arrIndex['Mar2019'];
                                  $totalCal2Past =$arrIndex['Mar2018'];
                            }
                            if($reqIdx == 'Total Assets'){
                                  $totalCal3 =$arrIndex['Mar2019'];
                                  $totalCal3Past =$arrIndex['Mar2018'];
                            }
                          }else{
                            if($reqIdx == 'Total Non-Current Assets'){
                                  $totalCal1 =$arrIndex['Mar2019'];
                                  $totalCal1Past =$arrIndex['Mar2018'];
                            }
                            if($reqIdx == 'Total Current Assets'){
                                  $totalCal2 =$arrIndex['Mar2019'];
                                  $totalCal2Past =$arrIndex['Mar2018'];
                            }
                            if($reqIdx == 'Total Assets'){
                                  $totalCal3 =$arrIndex['Mar2019'];
                                  $totalCal3Past =$arrIndex['Mar2018'];
                            }
                          }
                              
                          if(in_array($arrIndex['Particulars'],$getRows)){
                            $style ='';
                            if($arrIndex['Particulars'] =='Total Liabilities' || $arrIndex['Particulars'] ==trim('Total Assets')){
                                $style ='style="font-weight:bold;"';
                              }
                            echo '<tr '.$style.'>';
                              foreach ($arrIndex as $inrkey => $inrvalue) {
                                
                               if($inrkey == 'Particulars'){
                                @endphp
                                  <td class="big-font" {{$style}}>@php 
                                  if( $inrvalue =='Cash and balance with Reserve Bank of India'){
                                    echo 'Cash and balance with RBI';
                                  }else{
                                    echo $inrvalue;
                                  }
                                  @endphp
                                  </td>
                                @php 
                                }else{
                                @endphp
                                 <td class="text-center" {{$style}}>
                                    {{@number_format(@$inrvalue,2)}}
                                 </td>
                                 @php
                                }
                              }
                            echo '</tr>';
                            echo ($style)?'<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>':'';
                          }
                          
                        }
                         
                     }
              @endphp
              </tbody>
            </table>
        </div>
        <!-- /.balnce_table -->

        <div class="marketDetails" id="">
            <h5>Growth Compared to Last Year </h5>
            @php 
              if($sector =='Bank'){
                  $cal1Title ='Cash and balance with RBI (%)';
                  $cal2Title ='Advances (%)';
                  $cal3Title ='Total Assets Growth (%)';
              }else{
                $cal1Title ='Non Current Assets Growth (%)';
                $cal2Title ='Current Assets Growth (%)';
                $cal3Title ='Total Assets Growth (%)';

              }
              
              $totalCal1Pre =@(number_format(((@$totalCal1-$totalCal1Past)/$totalCal1Past)*100,2));
              $totalCal2Pre =@(number_format(((@$totalCal2-$totalCal2Past)/$totalCal2Past)*100,2));
              $totalCal3Pre =@(number_format(((@$totalCal3-$totalCal3Past)/$totalCal3Past)*100,2));
            @endphp
            <div class="row">
                <div class="col-md-4">
                  <span class="name">{{@$cal1Title}}</span><br>
                  @if($totalCal1Pre > 0)
                      <span class="value text-green"> <span class="fa fa-arrow-up"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal1Pre}}%</span> </span> <br>
                    @else
                      <span class="value text-red"> <span class="fa fa-arrow-down"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal1Pre}}%</span> </span> <br>
                    @endif
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                  <span class="name">{{$cal2Title}}</span><br>
                   @if($totalCal2Pre > 0)
                      <span class="value text-green"> <span class="fa fa-arrow-up"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal2Pre}}%</span> </span> <br>
                    @else
                      <span class="value text-red"> <span class="fa fa-arrow-down"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal2Pre}}%</span> </span> <br>
                    @endif
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                  <span class="name">{{$cal3Title}}</span><br>
                  @if($totalCal3Pre > 0)
                      <span class="value text-green"> <span class="fa fa-arrow-up"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal3Pre}}%</span> </span> <br>
                    @else
                      <span class="value text-red"> <span class="fa fa-arrow-down"></span> <span id="3yearAssetGrowthBlnsht">{{@$totalCal3Pre}}%</span> </span> <br>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif