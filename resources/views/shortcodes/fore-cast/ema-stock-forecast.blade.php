<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="ema-stock-forecast-calculator" class="bothtab-st-id-wrap">
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#emaForeCastStock" role="tab" data-toggle="tab" aria-controls="emaForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#emaForeCastIndices" role="tab" data-toggle="tab" aria-controls="emaForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="emaForeCastStock" class="sintab-stock-cal-wrap tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
        </div>
        <div id="emaForeCastIndices" class="sintab-stock-cal-wrap tab-pane fade" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="emaForeCastStock" class="sintab-stock-cal-wrap tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
            </div>
        @else
        <div id="emaForeCastIndices" class="sintab-stock-cal-wrap tab-pane fade show active" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
            </div>
        @endif
    @endif

</div>