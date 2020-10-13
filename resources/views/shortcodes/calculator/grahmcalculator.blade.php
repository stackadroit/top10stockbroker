<h2>{{ $title }}</h2>
<section class="couter">       
    <div class="cinner bdrtp">
        <div class="cleft pad-btm cntr">
            <span>Current Share Price*</span>
        </div>
        <div class="cright pad-btm"> 
            <input type="number" class="cntr" value="" id="crnt_share_price_id"> 
        </div>
        <div class="cleft pad-btm cntr">
            <span> EPS for last four quarters(EPS)</span>
        </div>
        <div class="cright pad-btm">
            <input class="cntr" type="number" value="" id="eps_id" >
        </div>
        <div class="cleft pad-btm cntr">
            <span> Expected growth rate(g) </span>
        </div>
        <div class="cright pad-btm">
            <input  class="cntr" type="number" value="" id="g_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span>The average yield of AAA corporate bonds in 1962 </span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr" type="number" value="4.4" id="bond1962_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span> The current yield on AAA corporate bonds (Y) </span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr"  type="number" value="4.22" id="y_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span> PE of stock with Zero growth </span>
        </div>
        <div class="cright pad-btm">
            <input class="cntr" type="number" value="8.5" id="pe_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span> Growth rate multiple </span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr" type="number" value="2" id="grm_id">
        </div>
        <span>The field below will show the intrinsic value of the stock based on graham's number</span>
        <div class="cleft pad-btm tright">
            <span class="pad-rt"> Intrinsic Value per share</span>
        </div>
        <div class="cright pad-btm">
            <input class="cntr" type="text" value="" id="intrinsic_share_price_id" readonly>
        </div>
        <div class="cleft pad-btm tright">
            <span class="pad-rt">  Overvalued (%)</span>
        </div>
        <div class="cright pad-btm">
            <input class="cntr" type="text" value="" id="overvalued_id" readonly>
        </div>
    </div>
</section>
