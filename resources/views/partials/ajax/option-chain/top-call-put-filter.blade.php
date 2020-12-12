@if(is_array(@$tableData))
<div class="scrollbar-inner">
  <table class="table-style1 {{(@$section =='read_more') ?'mb-20':'mb-0' }}">
    <thead>
      <tr>
        <th class="big-font">Symbol</th>
        <th class="big-font">Expiry</th>
        <th class="big-font">Put OI</th>
        <th class="big-font">Call OI</th>
        <th class="big-font">Put Call Ratio</th>
      </tr>
    </thead>
    <tbody>
    @php
            if(@$tableTotalRow){
             foreach ($tableData as $idxKey =>$rowObj){
                $rowObj =(array) $rowObj;
         @endphp
                <tr>
                       <td>
                        @php
                          $smId =@$optionChainSymbol[@$rowObj['Symbol']];
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
                       <td>{{@number_format(@$rowObj['Put'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Call'],2)}}</td>
                       <td>{{@number_format(@$rowObj['Ratio'],2)}}</td>
                   </tr>
          @php
            }
         }else{
            echo '<tr><td colspan="10">No data found(s).</td></tr>';
         }
         @endphp
            </tbody>
        </table>
     </div>
        @php
          $rmID= $InstName;
          if(@$section =='read_more'){
          @endphp
                <div class="alm-btn-wrap" id="loadMoreWrap_{{@$rmID}}">
                    <button class="alm-load-more-btn" id="loadMore_{{@$rmID}}" href="javascript:void(0);" data-page_no="1" data-total="{{$tableTotalRow}}">Load More</button>
                </div>
         @php 
            }
         @endphp         
@endif
  