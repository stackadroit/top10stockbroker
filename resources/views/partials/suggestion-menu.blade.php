<div class="suggestion-menu">
    <ul>
        @foreach( $suggestion_menu['get_meta'] as $gm ) 
            <li class="@if( $suggestion_menu['current_url'] == $gm['purl'] ) current @endif">
            	<a href="{{ $gm['purl'] }}"> {{ $gm['ptitle'] }} </a>
            </li>
        @endforeach    
    </ul>
</div><!-- custom menu class -->