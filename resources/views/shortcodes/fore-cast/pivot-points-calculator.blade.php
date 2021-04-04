<div data-id="{{@$id}}" data-calculate-button="{{ @$calculate_button }}" id="pivot-point-calculator">
	<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                    	<a href="#pivotPointStock" role="tab" data-toggle="tab" aria-controls="pivotPointStock" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                    	<a href="#pivotPointIndices" role="tab" data-toggle="tab" aria-controls="pivotPointIndices">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="pivotPointStock" class="tab-pane fade show active" data-fincode="{{@$finCode}}" data-filter="{{@$stock_filter}}">
              
        </div>
        
        <div id="pivotPointIndices" class="tab-pane fade" data-index-code="{{@$indexCode}}" data-filter="{{@$index_filter}}">
             
        </div>
        
    </div>
</div>