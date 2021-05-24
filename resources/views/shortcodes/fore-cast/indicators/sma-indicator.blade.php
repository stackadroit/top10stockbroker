<div data-id="{{@$id}}" id="main-sma-indicator" class="bothtab-st-id-wrap">
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#stocksSmaIndicator" role="tab" data-toggle="tab" aria-controls="stocksSmaIndicator" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#indicesSmaIndicator" role="tab" data-toggle="tab" aria-controls="indicesSmaIndicator">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="stocksSmaIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
        </div>
        <div id="indicesSmaIndicator" class="sintab-stock-cal-wrap tab-pane fade">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="stocksSmaIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @else
        <div id="indicesSmaIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @endif
    @endif
</div>
