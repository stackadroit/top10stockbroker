<h2>{{ $title }}</h2>
<section class="couter">       
    <div class="cinner bdrtp">
        <div class="cleft pad-btm cntr">
            <span>  Risk Free Rate  (%)* </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr" value="10" id="risk_free_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span>Beta* </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr" value="2" id="beta_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span> Return on the Market (%)* </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr"value="12" id="return_mkt_id">
        </div>
        <div class="cleft pad-btm tright">
            <span class="pad-rt"> Expected Return (%)</span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr" type="text" value="14" id="er_id" readonly>
        </div>
    </div> 
</section>  
