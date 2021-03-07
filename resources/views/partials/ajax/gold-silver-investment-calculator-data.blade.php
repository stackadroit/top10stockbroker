<div class="result-wrap">
    <span class="pre-result">
        Total Worth : <span class=""> {{ (@$netWorth)?@$netWorth:'0.0' }} </span>
    </span>
    @if(@$totalProLoss)
    <span class="pre-result">
        {{ @$plText }} : <span class="{{ @$plClass }}"> {{ (@$totalProLoss)?@$totalProLoss:'0.0' }} Rs. </span>
    </span>
    @endif
    @if(@$totalProLossPre)
    <span class="pre-result">
        {{ @$plpText }} : <span class="{{ @$plpClass }}"> {{ (@$totalProLossPre)?@$totalProLossPre:'0.0' }} % </span>
    </span>
    @endif
</div>