@if($choose_broker['cb_posts'])
<div align="center">
  <h4>Choose Broker    
    <select name="choose_broker" id="choose_broker">
      @foreach($choose_broker['cb_posts'] as $cb)
          <option value="{{ get_the_permalink($cb['ID'])}}" {{ ($cb['ID']==get_the_ID())? 'selected="selected"':'' }}>
            {{$cb['post_title']}}
          </option>
      @endforeach
    </select>
  </h4>
</div>
@endif
  