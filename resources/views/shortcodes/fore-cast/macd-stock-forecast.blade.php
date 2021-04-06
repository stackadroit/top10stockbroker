<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="macd-stock-forecast-calculator">
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
        <div id="macdForeCastStock" class="tab-pane fade show active" data-fincode="{{@$finCode}}" data-filter="{{@$stock_filter}}">
              
        </div>
        
        <div id="macdForeCastIndices" class="tab-pane fade" data-index-code="{{@$indexCode}}" data-filter="{{@$index_filter}}">
             
        </div>
        
    </div>
</div>