<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="so-stock-forecast-calculator">
    @if($tabs)
    <div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#soForeCastStock" role="tab" data-toggle="tab" aria-controls="soForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#soForeCastIndices" role="tab" data-toggle="tab" aria-controls="soForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="soForeCastStock" class="tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
        </div>
        <div id="soForeCastIndices" class="tab-pane fade" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="soForeCastStock" class="tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
            </div>
        @else
        <div id="soForeCastIndices" class="tab-pane fade show active" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
            </div>
        @endif
    @endif

</div>