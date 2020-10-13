<h2>{{ $title }}</h2>
<section class="couter">       
<div class="cinner bdrtp">
    <div class="cleft pad-btm cntr">
        <span> EBIT (Rs.) * </span>
    </div>
    <div class="cright pad-btm">
        <input type="number" class="cntr" value="100000" id="eb_id">
    </div>
    <div class="cleft pad-btm cntr">
        <span>Interest Expense (Rs.)* </span>
    </div>
    <div class="cright pad-btm">
     <input type="number" class="cntr" value="30000" id="ie_id">
    </div>
    <div class="cleft pad-btm tright">
        <span class="pad-rt"> Gross Profit Margin (%)</span>
    </div>
    <div class="cright pad-btm"> 
        <input  class="cntr"   type="text" value="3.30" id="icr1_id" readonly>
    </div>
</div> 
<div class="infopad">
    <div class="calinfo cntr">
        Interest Coverage Ratio = EBIT / Interest Expense
    </div>
</div>
</section> 