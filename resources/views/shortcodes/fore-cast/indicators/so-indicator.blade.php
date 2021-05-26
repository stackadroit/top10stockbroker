<div data-id="{{@$id}}" id="main-so-indicator" class="bothtab-st-id-wrap indicator-data-wrap">
        <div class="row"> 
            <div class="col-md-4"> </div>
            <div class="col-md-4"> 
                <div class="more-indicator-wrap"> 
                    <!-- more-indicator-filter Id is requied -->
                    <select class="more-indicator-filter" id="more-indicator-filter">
                        <option>Select Indicator</option>
                        @foreach($chieldPages as $url => $name)
                            <option value="{{ $url }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4"> </div>
        </div>
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#stocksSoIndicator" role="tab" data-toggle="tab" aria-controls="stocksSoIndicator" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#indicesSoIndicator" role="tab" data-toggle="tab" aria-controls="indicesSoIndicator">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="stocksSoIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
        </div>
        <div id="indicesSoIndicator" class="sintab-stock-cal-wrap tab-pane fade">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="stocksSoIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @else
        <div id="indicesSoIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @endif
    @endif
</div>
