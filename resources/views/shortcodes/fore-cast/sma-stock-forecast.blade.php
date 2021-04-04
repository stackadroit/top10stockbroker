<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="sma-stock-forecast-calculator">
	<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                    	<a href="#smaForeCastStock" role="tab" data-toggle="tab" aria-controls="smaForeCastStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                    	<a href="#smaForeCastIndices" role="tab" data-toggle="tab" aria-controls="smaForeCastIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="smaForeCastStock" class="tab-pane fade show active" data-fincode="{{@$finCode}}" data-filter="{{@$stock_filter}}">
              
        </div>
        
        <div id="smaForeCastIndices" class="tab-pane fade" data-index-code="{{@$indexCode}}" data-filter="{{@$index_filter}}">
             
        </div>
        
    </div>
</div>