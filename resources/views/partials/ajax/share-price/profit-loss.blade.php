@if(@$profitResposeArray)
<div class="section_profitLoss section-padding">
    <div class="inner-wrap">
        <div class="section-head">  
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <div class="porfitls_table scrollbar-inner">
            <table class="table-style1 th-border">
               <thead>
                  <tr>
                     @php 
                     foreach ($profitResposeArray as $key => $value) {
                        if($key ==0){
                          $arrIndex =(array) $value;
                          // print_r($arrIndex);
                          foreach ($arrIndex as $inrkey => $inrvalue) {
                           if($inrkey == 'Particulars'){
                            @endphp
                            <th>{{$inrkey}}</th>
                            @php
                           }else{
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
                      $getProfitRows =array(
                        'Total Income',
                        'Interest Expended',
                        'Operating Expenses',
                        'Provisions and Contingencies',
                        'Profit Before Tax',
                        // 'Taxes',
                        'Profit After Tax',
                        'Earnings Per Share',
                        'Adjusted EPS',
                      );
                  }else{
                      $getProfitRows =array(
                      'Total Income'=>'Total Income',
                      'Total Expenditure',
                      'Profit Before Tax',
                      // 'Provision for Tax / Taxes',
                      'Profit After Tax',
                      'Earnings Per Share',
                      'Adjusted EPS',
                    );

                  }
                  $arrayList=array();
                  $fndtot_inc =0;
                  foreach ($profitResposeArray as $key => $value) {
                      if($key !=0){
                        $arrIndex =(array) $value;
                        $reqIdx= str_replace('&nbsp;','',trim($arrIndex['Particulars']));
                      if($sector =='Bank'){
                        if(in_array($reqIdx, $getProfitRows)){
                            $arrayList[$reqIdx]=$arrIndex;
                          }elseif($reqIdx =='Provision for Tax' || $reqIdx =='Taxes'){
                            $arrayList['Taxes']=$arrIndex;
                          }
                      }else{
                        if($fndtot_inc ==0 && ($reqIdx  == 'Total Income' || $reqIdx=='Net Sales'  || $reqIdx=='Operating Income (Net)')){
                            if($arrIndex['Particulars']  == 'Total Income'){
                              $fndtot_inc =1;
                            }
                            if(!array_key_exists('Total Income', $arrayList)){
                              $arrayList['Total Income']=$arrIndex;
                            }
                          }elseif(in_array($reqIdx, $getProfitRows)){
                             $arrayList[$arrIndex['Particulars']]=$arrIndex;
                          }elseif($reqIdx =='Provision for Tax' || $reqIdx =='Taxes'){
                            $arrayList['Taxes']=$arrIndex;
                          }
                        }
                      }
                  }
                    $totalIncome =0;
                    $profitBeforeTax =0;
                    $profitAfterTax =0;
                    $totalIncomePast =0;
                    $profitBeforeTaxPast =0;
                    $profitAfterTaxPast =0;
                    if(is_array($arrayList)){
                      foreach ($arrayList as $key => $value) {
                            $arrIndex =(array) $value;
                            
                                $style ='';
                                if($arrIndex['Particulars'] =='Profit After Tax'){
                                    $style ='style="font-weight:bold;"';
                                  }
                                echo '<tr '.$style.'>';
                                $fhx=0;
                                foreach ($arrIndex as $inrkey => $inrvalue) {
                                  $reqIdx= str_replace('&nbsp;','',trim($key));
                                  if($reqIdx == 'Total Income'){
                                      if ($fhx ==1) {
                                          $totalIncome =$inrvalue;
                                      }
                                      if($fhx ==2) {
                                          $totalIncomePast =$inrvalue;

                                      }
                                    $fhx++;
                                  }
                                  if($reqIdx == 'Profit Before Tax'){
                                     if ($fhx ==1) {
                                        $profitBeforeTax =$inrvalue;
                                      }
                                      if($fhx ==2) {
                                        $profitBeforeTaxPast =$inrvalue;

                                      }
                                    $fhx++;
                                  }
                                  if($reqIdx == 'Profit After Tax'){
                                     if ($fhx ==1) {
                                        $profitAfterTax =$inrvalue;
                                      }
                                      if($fhx ==2) {
                                        $profitAfterTaxPast =$inrvalue;

                                      }
                                    $fhx++;
                                  }
                                 if($inrkey == 'Particulars'){
                                  @endphp
                                    <td class="big-font">{{ str_replace('&nbsp;','',$key)}}</td>

                                  @php 
                                  }else{
                                    @endphp
                                   <td class="text-center">{{($inrvalue)?@number_format($inrvalue,2):0}}</td>
                                    @php
                                  }
                                }
                              echo '</tr>';
                              echo ($style)?'<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>':'';
                            
                      }
                    }
                  @endphp
               </tbody>
            </table>
        </div>
        <div class="marketDetails" id="pnlLeft">
            <h5>Growth Compared to Last Year </h5>
            @php
             $totalIncomePre =0;
            $profitBeforeTaxPre =0;
            $profitAfterTaxPre =0;
            if($totalIncomePast != 0)
                $totalIncomePre =@number_format((($totalIncome- $totalIncomePast) /$totalIncomePast)*100,2);
              if($profitBeforeTaxPast != 0)
              $profitBeforeTaxPre =@number_format((($profitBeforeTax- $profitBeforeTaxPast) /($profitBeforeTaxPast))*100,2);
            if($profitAfterTaxPast != 0)
              $profitAfterTaxPre =@number_format((($profitAfterTax- $profitAfterTaxPast) /($profitAfterTaxPast))*100,2);
             @endphp
            <div class="row">
                <div class="col-6 col-md-3">
                  <span class="name">Total Income (%)</span><br>
                  @if($totalIncomePre >0)
                    <span class="value text-green"> <span class="fa fa-arrow-up"></span> 
                    <span id="profitlossSales">{{$totalIncomePre}}%</span> </span> <br>
                    @else
                    <span class="value text-red"> <span class="fa fa-arrow-down"></span> 
                    <span id="profitlossSales">{{$totalIncomePre}}%</span> </span> <br>
                   @endif
                </div>
                <div class="col-6 col-md-3">
                  <span class="name">Profit Before Tax (%)</span><br>
                  @if($profitBeforeTaxPre >0)
                    <span class="value text-green"> <span class="fa fa-arrow-up"></span> 
                    <span id="profitlossSalesAvg">{{$profitBeforeTaxPre}}%</span> </span> <br>
                   @else
                    <span class="value text-red"> <span class="fa fa-arrow-down"></span> 
                    <span id="profitlossSalesAvg">{{$profitBeforeTaxPre}}%</span> </span> <br>
                   @endif
                </div>
                <div class="col-6 col-md-3">
                  <span class="name">Profit After Tax (%)</span><br>
                ` @if($profitAfterTaxPre >0)
                    <span class="value text-green"> <span class="fa fa-arrow-up"></span> 
                    <span id="profitlossPAT">{{$profitAfterTaxPre}}%</span> </span> <br>
                    @else
                    <span class="value text-red"> <span class="fa fa-arrow-down"></span> 
                    <span id="profitlossPAT">{{$profitAfterTaxPre}}%</span> </span> <br>
                    <@endif 
                </div>
           </div>
        </div>
    </div>
</div>
@endif