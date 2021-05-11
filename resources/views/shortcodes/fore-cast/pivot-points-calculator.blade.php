<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="pp-stock-forecast-calculator" class="bothtab-st-id-wrap">
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#ppForeCastStock" role="tab" data-toggle="tab" aria-controls="ppForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#ppForeCastIndices" role="tab" data-toggle="tab" aria-controls="ppForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="ppForeCastStock" class="sintab-stock-cal-wrap tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
        </div>
        <div id="ppForeCastIndices" class="sintab-stock-cal-wrap tab-pane fade" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="ppForeCastStock" class="sintab-stock-cal-wrap tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
            </div>
        @else
        <div id="ppForeCastIndices" class="sintab-stock-cal-wrap tab-pane fade show active" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
            </div>
        @endif
    @endif

</div>