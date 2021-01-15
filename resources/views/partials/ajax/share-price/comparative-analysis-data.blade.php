@php
if(is_array(@$comparativeAnalysis)) { 
@endphp
<div class="section_comparativeRet pb-5">
    <div class="inner-wrap">
        <div class="section-head">
            <h2 class="">{{@$section_title }}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <div class="compartive_table table-responsive tb-fixed-head" data-simplebar data-simplebar-auto-hide="false" id="5">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">1 Day (%)</th>
                        <th class="text-center">1 Week (%)</th>
                        <th class="text-center">1 Month (%)</th>                 
                        <th class="text-center">3 Month (%)</th>
                        <th class="text-center">6 Month (%)</th>
                        <th class="text-center">1 Year (%)</th>                 
                        <th class="text-center">3 Year (%)</th>
                        <th class="text-center">5 Year (%)</th>
                    </tr>
                </thead>
                <tbody>
                  @php 
                 
                  $caprowComp =array(
                    @$cDetailsresponse['s_name']=>'#',
                    'NIFTY 50'=>'share-market/nifty/',
                    'NIFTY NEXT 50'=>'share-market/nifty-next-50/',
                    'NIFTY 100'=>'share-market/nifty-100/',
                    'NIFTY 200'=>'share-market/nifty-200/',
                    'NIFTY 500'=>'share-market/nifty-500/',
                    'NIFTY MNC'=>'share-market/nifty-mnc/',
                    'NIFTY MIDCAP 50'=>'share-market/nifty-midcap-50/',
                    'NIFTY SMALLCAP 50'=>'share-market/nifty-smallcap-50/',
                    'S&P Bse Sensex'=>'share-market/sensex/',
                    'S&P Bse 100'=>'share-market/bse-100/',
                    'S&P Bse 200'=>'share-market/bse-200/',
                    'S&P Bse 500'=>'share-market/bse-500/',
                  );
                  $inpod=0;
                  foreach ($comparativeAnalysis as $key => $rowArray) {
                    $rowObj = (array) $rowArray;
                    // echo '<pre>';
                    // print_r($rowObj);
                      $cpnName= (@$rowObj['S_NAME'])?@$rowObj['S_NAME']:@$rowObj['INDEX_LNAME'];
                      $nameslug =strtolower(str_replace(' ', '-', $cpnName)).'-share-price';
                    if(array_key_exists($cpnName, $caprowComp)){
                    @endphp
                    <tr>
                        <td class="big-font">
                        @if($inpod) 
                            <a href="{{site_url('/') .$caprowComp[$cpnName]}}"  title="{{$cpnName}}">
                            {{$cpnName}}
                                
                            </a>
                        @else
                            {{$cpnName}} 
                        @endif
                        </td>
                        <td class="text-center">{{@$rowObj['PER_CHANGE']}}</td>
                        <td class="text-center">{{@$rowObj['WEEKPERCHANGE']}}</td>
                        <td class="text-center">{{@$rowObj['MONTHPERCHANGE']}}</td>                 
                        <td class="text-center">{{@$rowObj['3MONTHPERCHANGE']}}</td>
                        <td class="text-center">{{@$rowObj['6MONTHPERCHANGE']}}</td>
                        <td class="text-center">{{@$rowObj['1YEARPERCHANGE']}}</td>                 
                        <td class="text-center">{{@$rowObj['3YEARPERCHANGE']}}</td>
                        <td class="text-center">{{@$rowObj['5YEARPERCHANGE']}}</td>
                    </tr>
                    @php
                    $inpod++;
                    }
                  } 
                  @endphp
                </tbody>
            </table>
        </div>
        <!-- /.compartive_table -->
    </div>
    <!-- /.inner-wrap -->
</div>
<!-- /.section_comparativeRet -->
@php } @endphp