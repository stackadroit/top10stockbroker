@php
if(@$fundamentalAnalysisArray){ 
  $fundamentalAnalysisArray =(array) @$fundamentalAnalysisArray->Table1;
    $pageID = !empty($pageID) ? $pageID : get_the_ID();

@endphp
<div class="section_balanceSheet pb-5">
    <div class="inner-wrap">
        <div class="section-head">  
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        
        <div class="balnce_table table-responsive">
            <table class="table-style1 table-bordered">
               <thead>
                  <tr>
                     <th></th>
                     @php 
                     foreach ($fundamentalAnalysisArray as $key => $value) {
                        if($key ==0){
                          $arrIndex =(array) $value;
                          // print_r($arrIndex);
                          foreach ($arrIndex as $inrkey => $inrvalue) {
                           if($inrkey != 'Particulars'){
                           @endphp
                            <th class="text-center"><?php echo $inrkey; ?>
                            <!-- <br>
                              (<span style="font-size:13px"><span class="icon-rupees_1"></span> in Cr.</span>)  -->
                            </th>
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
                    $getRows =array(
                    'Earnings Per Share (Rs)'=>'Earnings per Share (Rs.)',
                    'DPS(Rs)'=>'Dividend per Share (Rs.)',
                    'Yield on Advances'=>'Yield on Advances (%)',
                    'Cost of Liabilities'=>'Cost of Liabilities (%)',
                    'ROA(%)'=>'Return on Assets(%)',
                    'ROE(%)'=>'Return on Equity(%)',
                    'Cost Income Ratio'=>'Cost Income Ratio (x)',
                    'Operating Costs to Assets'=>'Operating Costs to Assets (x)',
                    'PER(x)'=>'Price to Earnings (x)',
                    'Yield(%)'=>'Dividend Yeild (%)',
                    'Core Operating Income Growth'=>'Operating Income Growth (%)',
                    'Net Profit Growth'=>'Net Profit Growth (%)',
                    'Investment / Deposits(x)'=>'Investment / Deposits(x)',
                    'IncLoan / Deposits(x)'=>'IncLoan / Deposits(x)',
                    );
                  }else{
                    $getRows =array(
                      'Earnings Per Share (Rs)'=>'Earnings per Share (Rs.)',
                      'DPS(Rs)'=>'Dividend per Share (Rs.)',
                      'PAT Margin (%)'=>'PAT Margin (%)',
                      'Cash Profit Margin (%)'=>'Cash Profit Margin (%)',
                      'ROA(%)'=>'Return on Assets (%)',
                      'Asset Turnover(x)'=>'Asset Turnover(x)',
                      'Fixed Capital/Sales(x)'=>'Fixed Capital/Sales(x)',
                      'PER(x)'=>'Price to Earnings',
                      'Yield(%)'=>'Dividend Yeild',
                      'Net Sales Growth(%)'=>'Net Sales Growth(%)',
                      'PAT Growth(%)'=>'PAT Growth(%)',
                      'Total Debt/Equity(x)'=>'Total Debt/Equity(x)',
                      'Current Ratio(x)'=>'Current Ratio(x)',
                      'Quick Ratio(x)'=>'Quick Ratio(x)'
                    );
                  }
                     
                     foreach ($fundamentalAnalysisArray as $key => $value) {
                        if($key !=0){
                          $arrIndex =(array) $value;
                          $reqIdx= str_replace('&nbsp;','',trim($arrIndex['Particulars']));
                          if(array_key_exists($reqIdx,$getRows)){
                            $style ='';
                            echo '<tr '.$style.'>';
                              foreach ($arrIndex as $inrkey => $inrvalue) {
                                
                               if($inrkey == 'Particulars'){
                               @endphp
                                  <td class="big-font" {{$style}}>
                                    {{$getRows[$reqIdx]}}
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
                          }
                          
                        }
                         
                     }
             @endphp
              </tbody>
            </table>
        </div>
        <!-- /.balnce_table -->
         
    </div>
    <!-- /.inner -->
</div>
<!-- /.section_balanceSheet -->
@php } @endphp