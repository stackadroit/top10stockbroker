<div class="selectbrockerdiv" id="broker-search-wrap">
    <div class="broker-title">
    <h4>Search Branch by Broker and City </h4>
    </div>
    <div class="row">

        <div class="selectbrkerdata col-sm-5">
            <select class="compatess1" id="searched_broker" style="border-color: rgb(204, 204, 204);">
                <option value="0" data-slug="">Select Broker</option>
               @php 
               foreach($brokers as $rowObj){
                   echo '<option value="'.$rowObj->term_id.'"  data-slug="'.$rowObj->slug.'">'.$rowObj->name.'</option>';
               }
               @endphp
            </select>
        </div>
        <div class="selectbrkerdata  col-sm-5">
            <select class="compatess2" name="broker2" style="border-color: rgb(204, 204, 204);" id="searched_city">
                <option  value="0" data-slug="">Select City</option>
                    '.$locationsHtml.'
            </select>
        </div>
        <div class="resultcom  col-sm-2">
            <button type="button" class="comlink btn btn-primary" id="search_branch_by_broker_city">Submit</button>
        </div>
    </div>
</div>