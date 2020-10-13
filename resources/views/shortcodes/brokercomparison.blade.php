<div class="selectbrockerdiv">  
    <div class="broker-title">
        <h4>Compare Stock Brokers</h4>
    </div>
    <div class="selectbrkerdata">
        <select id="broker1" class="compatess1" name="broker1" style="border-color: rgb(204, 204, 204);">
            <option value="00">Select Broker 1</option>     
            @foreach($ubroker1 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach       
         </select>
    </div>
    <div class="selectbrkerdata">
        <select class="compatess2" id="broker2"  name="broker2" style="border-color: rgb(204, 204, 204);">
        	<option value="00">Select Broker 2</option>
        	@foreach($ubroker2 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach 
        </select>
    </div>
    <div class="resultcom">
        <button class="comlink">Compare</button>
    </div>
</div>