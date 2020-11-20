<div class="custom-menu-class">
    <ul>
		@foreach( $get_meta as $gm ) 
		<li class="{{ @if($current_url == @$gm['purl']) current @endif }}">
			<a href="{!! @$gm['purl'] !!}"> {{ @$gm['ptitle'] }} </a>
		</li>
		@endforeach
    </ul>
</div><!-- custom menu class -->