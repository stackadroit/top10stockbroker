<div class="custom-menu-class">
    <ul>
		@foreach( $get_meta as $gm ) 
		<li class="{{ $current_url == @$gm['purl']  ? 'current': '' }}">
			<a href="{!! @$gm['purl'] !!}"> {{ @$gm['ptitle'] }} </a>
		</li>
		@endforeach
    </ul>
</div><!-- custom menu class -->