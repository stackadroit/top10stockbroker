<div id="invCalculator">
<h3 class="font-weight-bold text-center">Calculate your return on investment!</h3>
<form action="">
  <div class="form-row">
    <div class="form-group col-md-6 my-1">
        <label for="price">Investment Amount</label>
        <input type="text" name="price" id="price" value="500000" class="form-control input-hi4">
    </div>
    <div class="form-group col-md-4 my-1">
      <label for="invyear">Select Year</label>
      <select id="invyear">
        <option value="3M">3 Months</option>
        <option value="6M">6 Months</option>
        <option value="1Y">1 Year</option>
        <option value="2Y">2 Year</option>
        <option value="3Y">3 Year</option>    
        <option value="4Y">4 Year</option>
        <option value="5Y">5 Year</option>
      </select>
    </div>
    <div class="form-group col-md-2 my-1">
        <label for="update">Calculate</label>
        <button id="update">Calculate</button>
    </div>
  </div>
</form>
<br>
<table class="invData text-center">
<tr class="invdata-heading">
  <td>Asset Class</td>
  <td>ROI (Rs.)</td>
  <td>Profit (Rs.)</td>
  <td>Profit (%)</td>
</tr>
<tr>
  <td>IPO</td>
  <td class="ipoT"></td>
  <td class="ipoP"></td>
  <td class="ipoPR"></td>
</tr>
<tr>
  <td>Equity</td>
  <td class="equityT"></td>
  <td class="equityP"></td>
  <td class="equityPR"></td>
</tr>
<tr>
  <td>Savings</td>
  <td class="savingsT"></td>
  <td class="savingsP"></td>
  <td class="savingsPR"></td>
</tr>
<tr>
  <td>Real Estate</td>
  <td class="realestateT"></td>
  <td class="realestateP"></td>
  <td class="realestatePR"></td>
</tr>
<tr>
  <td>Gold</td>
  <td class="goldT"></td>
  <td class="goldP"></td>
  <td class="goldPR"></td>
</tr>
<tr>
  <td>Bonds</td>
  <td class="bondsT"></td>
  <td class="bondsP"></td>
  <td class="bondsPR"></td>
</tr>
<tr>
  <td>Fixed Deposit</td>
  <td class="fdT"></td>
  <td class="fdP"></td>
  <td class="fdPR"></td>
</tr>
<tr>
  <td>Mutual Fund</td>
  <td class="mutualfundT"></td>
  <td class="mutualfundP"></td>
  <td class="mutualfundPR"></td>
</tr>
</table>
</div> 