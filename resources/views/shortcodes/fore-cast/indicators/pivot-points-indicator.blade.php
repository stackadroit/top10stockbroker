<div data-id="{{@$id}}" id="main-pivot-points-indicator" class="bothtab-st-id-wrap">
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#stocksPivotPointsIndicator" role="tab" data-toggle="tab" aria-controls="stocks-pivot-points-indicator" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#indicesPivotPointsIndicator" role="tab" data-toggle="tab" aria-controls="indicesPivotPointsIndicator">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="stocksPivotPointsIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
        </div>
        <div id="indicesPivotPointsIndicator" class="sintab-stock-cal-wrap tab-pane fade">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="stocksPivotPointsIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @else
        <div id="indicesPivotPointsIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @endif
    @endif
</div>
