<h2>{{ $title }}</h2>
<section class="couter">       
    <div class="cinner bdrtp">
        <div class="cleft pad-btm cntr">
            <span> Principal (Rs.)* </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr" value="20000" id="principal_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span>Rate of Interest (%)*  </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr" value="10" id="rate_id">
        </div>
        <div class="cleft pad-btm cntr">
            <span>Time / Period (Yrs)*  </span>
        </div>
        <div class="cright pad-btm">
            <input type="number" class="cntr" value="5" id="prd_id">
        </div>
        <div class="cleft pad-btm tright">
            <span class="pad-rt">Simple Interest (Rs.)</span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr" type="text" value="10000" id="simple_interest_id" readonly>
        </div>
        <div class="cleft pad-btm tright">
            <span class="pad-rt">New Principal </span>
        </div>
        <div class="cright pad-btm"> 
            <input class="cntr" type="text" value="30000" id="new_principal_id" readonly>
        </div>
    </div>
</section> 