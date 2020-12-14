@if($choose_broker['cb_posts'])
<div align="center">
  <h4>Choose Broker    
    <select name="choose_broker" id="choose_broker">
      @php
         foreach($choose_broker['cb_posts'] as $cb){
        @endphp
          <option value="{{ get_the_permalink($cb['ID'])}}" {{ ($cb['ID']==get_the_ID())? 'selected="selected"':'' }}>
            {{$cb['post_title']}}
          </option>
         @php
          }
         @endphp
    </select>
  </h4>
</div>
@endif
  