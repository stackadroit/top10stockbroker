 @if(is_array(@$dividendResponse))
<div class="section_corporateDiv pb-5">
    <div class="inner-wrap clearfix">
        <div class="section-head">
            <h2 class="">{{@$section_title}}</h2>
            <p>{{@$section_content}}</p>
        </div>
        <div class="corpdiv_table table-responsive">
            <table class="table-style1 table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Dividend Date</th>
                        <th class="text-center">Record Date</th>
                        <th class="text-center">Dividend %</th>
                        <th class="text-center">Interim / Final / Dividend</th>
                    </tr>
                </thead>
                <tbody> 
                  @php
                    foreach ($dividendResponse as $key => $rowObj) {
                      $rowObj =(array) $rowObj;
                      $lavelClass ='text-red';
                      if($rowObj['Dividend %'] >0){
                        $lavelClass ='text-green';
                      }
                      @endphp
                      <tr>
                        <td class="text-center">{{@$rowObj['Dividend Date']}}</td>
                        <td class="text-center">{{$rowObj['Record Date']}}</td>
                        <td class="text-center">
                          <span class="{{$lavelClass}}">{{@number_format($rowObj['Dividend %'],2)}}%</span>
                        </td>
                        <td class="text-center">{{$rowObj['Interim / Final / Dividend']}}</td>
                      </tr>
                      @php
                    }
                   @endphp
                </tbody>
            </table>
        </div>  
    </div>
</div>
@endif