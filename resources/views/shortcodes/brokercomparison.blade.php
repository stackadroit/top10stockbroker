<div class="selectbrockerdiv form-row shortcode-bg " id="brokercomparison">  
    <div class="broker-title col-md-12">
        <h2 style="font-size: 1.4em;font-weight: 600;line-height: 24px;margin: 0 0 14px;">Compare Stock Brokers</h2>
    </div>
    <div class="selectbrkerdata col-md-5">
        <label for="brokerselect1" aria-label="Broker" style="display:block;">
            <select id="brokerselect1" class="compatess1" name="brokerselect1" style="border-color: rgb(204, 204, 204);">
                <option value="00">Select Broker 1</option>     
                @foreach($ubroker1 as $ub)
                     <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
                 @endforeach       
             </select>
         </label>
    </div>
    <div class="selectbrkerdata col-md-5 mt-3 mt-sm-0">
        <label for="brokerselect2" aria-label="Broker" style="display:block;">
        <select class="compatess2" id="brokerselect2"  name="brokerselect2" style="border-color: rgb(204, 204, 204);">
            <option value="00">Select Broker 2</option>
            @foreach($ubroker2 as $ub)
                 <option value="{{ str_replace(' ','-',$ub) }}">{{ ucwords($ub) }}</option>
             @endforeach 
        </select>
        </label>
    </div>
    <div class="resultcom col-md-2 mt-2 mt-sm-0">
        <button class="comlink" title="Compare">Compare</button>
    </div>
</div>