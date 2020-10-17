<div class="selectbrockerdiv form-row" id="brokercomparison">  
    <div class="broker-title col-md-12">
        <h4>Compare Stock Brokers</h4>
    </div>
    <div class="selectbrkerdata col-md-5">
        <select id="brokerselect1" class="compatess1" name="brokerselect1" style="border-color: rgb(204, 204, 204);">
            <option value="00">Select Broker 1</option>     
            @foreach($ubroker1 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach       
         </select>
    </div>
    <div class="selectbrkerdata col-md-5 m-t-5">
        <select class="compatess2" id="brokerselect2"  name="brokerselect2" style="border-color: rgb(204, 204, 204);">
        	<option value="00">Select Broker 2</option>
        	@foreach($ubroker2 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach 
        </select>
    </div>
    <div class="resultcom col-md-2">
        <button class="comlink">Compare</button>
    </div>
</div>