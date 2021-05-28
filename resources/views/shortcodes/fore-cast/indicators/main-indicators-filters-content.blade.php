<div class="row tab-holder">
            <div class="col-md-6"> 
                <ul class="nav nav-tabs tab-hori-1" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="#stocks{{$defaultCal}}Indicator" role="tab" data-toggle="tab" aria-controls="stocks{{$defaultCal}}Indicator" class="active">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a href="#indices{{$defaultCal}}Indicator" role="tab" data-toggle="tab" aria-controls="indices{{$defaultCal}}Indicator">Indices</a>
                    </li>
                     
                </ul>
            </div>
             
    </div>
    <div class="tab-content" id="myTabContent">
        <div id="stocks{{$defaultCal}}Indicator" class="sintab-stock-cal-wrap tab-pane fade show active">
        </div>
        <div id="indices{{$defaultCal}}Indicator" class="sintab-stock-cal-wrap tab-pane fade">
        </div>
    </div>