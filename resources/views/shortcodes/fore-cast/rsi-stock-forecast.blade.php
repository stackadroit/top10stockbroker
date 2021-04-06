<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="rsi-stock-forecast-calculator">
	<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                    	<a href="#rsiForeCastStock" role="tab" data-toggle="tab" aria-controls="rsiForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                    	<a href="#rsiForeCastIndices" role="tab" data-toggle="tab" aria-controls="rsiForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="rsiForeCastStock" class="tab-pane fade show active" data-fincode="{{@$finCode}}" data-filter="{{@$stock_filter}}">
              
        </div>
        
        <div id="rsiForeCastIndices" class="tab-pane fade" data-index-code="{{@$indexCode}}" data-filter="{{@$index_filter}}">
             
        </div>
        
    </div>
</div>