<div class="menudropdown-shortcode shortcode-bg" id="{{ $el_id }}">
    <h4>{{ $title }}</h4>
	<select class="dropdownmenusel" onchange="location = this.options[this.selectedIndex].value;" id="{{ $el_id }}">
		<option value="#"> Please Select</optiom>
	    @foreach ($array_menu as $md)
	    	<option value="{{ $md->url }}" {{ ( $md->url == $requested_url ) ? 'selected="selected"' : '' }} > {{ $md->title }} </option>
	    @endforeach
	</select>
</div>