<h2>{{ $title }}</h2>
<section class="couter shotcodwraper">       
    <div class="cinner form-row shortcode-bg">
        <div class="col-md-6 mt-1 mt-sm-2">
            <span> EBIT (Rs.) * </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <input type="number" class="form-control" value="100000" id="eb_id">
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
            <span>Interest Expense (Rs.)* </span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2">
         <input type="number" class="form-control" value="30000" id="ie_id">
        </div>
        <hr class="hori col-md-12">
        <div class="col-md-6 mt-1 mt-sm-2">
            <span class="pad-rt"> Gross Profit Margin (%)</span>
        </div>
        <div class="col-md-6 mt-1 mt-sm-2"> 
            <input  class="form-control"   type="text" value="3.30" id="icr1_id" readonly>
        </div>
    </div> 
    <div class="infopad">
        <div class="calinfo cntr">
            Interest Coverage Ratio = EBIT / Interest Expense
        </div>
    </div>
</section> 