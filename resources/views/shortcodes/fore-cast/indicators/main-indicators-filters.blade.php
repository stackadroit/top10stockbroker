<div data-id="{{@$id}}" id="main-indicator-filters" class="bothtab-st-id-wrap indicator-data-wrap main-indicator-filters-wrap" data-indicator="{{ $defaultCal }}">
    <div class="row"> 
            <div class="col-md-2 text-right"></div>
            <div class="col-md-3 text-right"><span class="select-label">Select Indicator</span></div>
            <div class="col-md-4"> 
                <div class="more-indicator-wrap">
                    <select class="main-indicator-filter" id="main-indicator-filter">
                        @foreach($chieldPages as $name => $label)
                            <option @if($defaultCal ==$name) selected="selected" @endif  value="{{ $name }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3"> </div>
    </div>
    <div id="main-indicator-filters-content" class="main-indicator-filters-content">
    </div>
</div>
