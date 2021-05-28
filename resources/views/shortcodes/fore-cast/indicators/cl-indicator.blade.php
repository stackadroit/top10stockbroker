<div data-id="{{@$id}}" id="main-cl-indicator" class="bothtab-st-id-wrap indicator-data-wrap">
    <div class="row"> 
            <div class="col-md-5 text-right"><span class="select-label">Select Indicator</span></div>
            <div class="col-md-4"> 
                <div class="more-indicator-wrap"> 
                    <!-- more-indicator-filter Id is requied -->
                    <select class="more-indicator-filter" id="more-indicator-filter">
                        @foreach($chieldPages as $pg)
                            <option @if(@$pg['page_id'] == $id) selected="selected" @endif value="{{ @$pg['url'] }}">{{ @$pg['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3"> </div>
    </div>
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#stocksClIndicator" role="tab" data-toggle="tab" aria-controls="stocksClIndicator" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#indicesClIndicator" role="tab" data-toggle="tab" aria-controls="indicesClIndicator">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="stocksClIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
        </div>
        <div id="indicesClIndicator" class="sintab-stock-cal-wrap tab-pane fade">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="stocksClIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @else
        <div id="indicesClIndicator" class="sintab-stock-cal-wrap tab-pane fade show active">
            </div>
        @endif
    @endif
</div>
