<h2>{{ $title }}</h2>
<section class="couter shotcodwraper">       
    <div class="cinner form-row shortcode-bg">
        <div class="col-md-6 mt-1 mt-sm-2">
            <span>Current Share Price*</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2"> 
            <input type="number" class="form-control" value="" id="crnt_share_price_id"> 
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> EPS for last four quarters(EPS)</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input class="form-control" type="number" value="" id="eps_id" >
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> Expected growth rate(g) </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input  class="form-control" type="number" value="" id="g_id">
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span>The average yield of AAA corporate bonds in 1962 </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2"> 
            <input class="form-control" type="number" value="4.4" id="bond1962_id">
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> The current yield on AAA corporate bonds (Y) </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2"> 
            <input class="form-control"  type="number" value="4.22" id="y_id">
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> PE of stock with Zero growth </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input class="form-control" type="number" value="8.5" id="pe_id">
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> Growth rate multiple </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2"> 
            <input class="form-control" type="number" value="2" id="grm_id">
        </div>
        <div class="col-md-12 mt-1 mt-sm-2">
            <span>The field below will show the intrinsic value of the stock based on graham's number</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span class="pad-rt"> Intrinsic Value per share</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input class="form-control" type="text" value="" id="intrinsic_share_price_id" readonly>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span class="pad-rt">  Overvalued (%)</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input class="form-control" type="text" value="" id="overvalued_id" readonly>
        </div>
    </div>
</section>
