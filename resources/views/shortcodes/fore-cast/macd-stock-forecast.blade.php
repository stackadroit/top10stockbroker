<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="macd-stock-forecast-calculator">
    @if($tabs)
	<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                    	<a href="#macdForeCastStock" role="tab" data-toggle="tab" aria-controls="macdForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                    	<a href="#macdForeCastIndices" role="tab" data-toggle="tab" aria-controls="macdForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="macdForeCastStock" class="tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
        </div>
        <div id="macdForeCastIndices" class="tab-pane fade" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
        </div>
    </div>
    @else
        @if($type =='Stock')
        <div id="macdForeCastStock" class="tab-pane fade show active" data-fincode="{{@$fin_code}}" data-filter="{{@$stock_filter}}">
            </div>
        @else
        <div id="macdForeCastIndices" class="tab-pane fade show active" data-index-code="{{@$index_code}}" data-filter="{{@$index_filter}}">
            </div>
        @endif
    @endif

</div>