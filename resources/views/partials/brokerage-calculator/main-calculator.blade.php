<main class="calculater" data-post-id="{{get_the_ID()}}">
  <input data-tab-idx="1" id="tab1" type="radio" name="tabs" checked>
  <label for="tab1">Equity Delivery</label>
  <input data-tab-idx="2" id="tab2" type="radio" name="tabs">
  <label for="tab2">Equity Intraday</label>
  <input data-tab-idx="3" id="tab3" type="radio" name="tabs">
  <label for="tab3">Equity Futures</label>
  <input  data-tab-idx="4" id="tab4" type="radio" name="tabs">
  <label for="tab4">Equity Options</label>
  <input data-tab-idx="5" id="tab5" type="radio" name="tabs">
  <label for="tab5">Currency Futures</label>
  <input data-tab-idx="6" id="tab6" type="radio" name="tabs">
  <label for="tab6">Currency Options</label>
  <input data-tab-idx="7" id="tab7" type="radio" name="tabs">
  <label for="tab7">Commodity</label>
  @php
    for($i=1;$i<=7;$i++)
    {
   @endphp
    <section id="content{{$i}}" align="center">
      <table style="width:99%;font-weight: bold;background-color: rgba(230, 223, 223, 0.2);" >
        <tr>
          <td>
           <label for="buy_price{{$i}}" style="padding: 0px;color: #000;"> 
          Buy Price (Rs.)
            </label>
            <span style="float:right;">
             <input type="number" name="buy_price{{$i}}" id="buy_price{{$i}}" />
            </span>
          </td>
          <td>
            <label for="sell_price{{$i}}" style="padding: 0px;color: #000;"> 
          Sell Price(Rs.)
        </label>
          <span style="float:right;">
            <input type="number" name="sell_price{{$i}}" id="sell_price{{$i}}" />
          </span>
          </td>
        </tr>
      @php 
      if($i==4 || $i==6)
      {
      @endphp
    
        <tr>
          <td>
            <label for="number_lot{{$i}}" style="padding: 0px;color: #000;"> 
            Number Of Lots
          </label>
            <span style="float:right;">
              <input type="number" name="number_lot{{$i}}" id="number_lot{{$i}}" />
            </span>
          </td>
          <td>
            <label for="lot_size{{$i}}" style="padding: 0px;color: #000;"> 
            Lots Size
          </label>
            <span style="float:right;">
              <input type="number" name="lot_size{{$i}}" id="lot_size{{$i}}" />
            </span>
          </td>
        </tr>
        <tr>
          <td>
            <label for="state{{$i}}" style="padding: 0px;color: #000;"> 
            State
          </label>
            <span style="float:right;">
              <select name="state{{$i}}" id="state{{$i}}">
              @php
              foreach($state_name as $key=>$val)
              {
                echo '<option value="'.$val.'" >'.$key.'</option>';
                
              }
              @endphp
              </select>
            </span>
          </td>
        </tr>
      @php
      } else {
      @endphp
      
        <tr>
          <td>
            <label for="number_share{{$i}}" style="padding: 0px;color: #000;"> 
            Number Of Shares
          </label>
            <span style="float:right;">
              <input type="number" name="number_share{{$i}}" id="number_share{{$i}}" />
            </span>
          </td>
          <td>
            <label for="state{{$i}}" style="padding: 0px;color: #000;">
            State
          </label>
            <span style="float:right;">
            <select name="state{{$i}}" id="state{{$i}}">
              @php
              foreach($state_name as $key=>$val)
              {
                echo '<option value="'.$val.'" >'.$key.'</option>';
                
              }
              @endphp
            </select>
            </span>
          </td>
        </tr>
      
      @php } @endphp
    
      <tr>
        <td colspan="2" style="text-align:center"> <input type="button" name="calculate" id="calculate{{$i}}" data-cal-idx="{{$i}}" Value="Calculate" /></td>
      </tr>
    </table>
    <table style="width:99%;font-weight: bold;background-color: rgba(230, 223, 223, 0.2);" align="center">
      <tr>
        <th colspan="2" align="center" style="background:#e55025;text-align:center;color:#fff;">
            Brokerage Calculate
        </th>
      </tr>
      <tr>
        <td width="65%">
          Total Turnover (Rs.)
        </td>
          
        <td>
          <span id="total_turnover{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Brokerage (Rs.)
        </td>
          
        <td>
          <span id="brokerage{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          STT (Rs.)
        </td>
          
        <td>
          <span id="stt{{$i}}" style="float:right;"> 
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          SEBI Turnover Fees (Rs.)
        </td>
          
        <td>
          <span id="sebi_turnover_fees{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Stamp Duty (Rs.)
        </td>
          
        <td>
          <span id="stamp_duty{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Transaction Charges (Rs.)
        </td>
          
        <td>
          <span id="transaction_charges{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          GST (Rs.)
        </td>
          
        <td>
          <span id="gst{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Total Brokerage & Tax (Rs.)
        </td>
          
        <td>
          <span id="total_brokerage{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Total Profit Or Loss (Rs.)
        </td>
          
        <td>
          <span id="total_profit{{$i}}" style="float:right;">
          -
          </span>
        </td>
      </tr>
    </table>
  </section>
  @php

  }
  @endphp
</main>

<p>
@php
  the_field('after_content', get_the_ID());
  the_field('after_content_brokerage_calculator', get_the_ID());
  $post_id =get_the_ID();
@endphp
</p>

<span class="tag-links">
  <i class="fa fa-tags"></i>
    @php $bct =  get_the_terms($post_id, 'brokerage-calculator_tag');
      //print_r($bct);
      if($bct):
      foreach($bct as $bc){
          echo '<a href="'.site_url().'/brokerage-calculator_tag/'.$bc->slug.'" rel="tag">'.$bc->name.',</a> ';
          
      }
      endif;
    @endphp
</span>
