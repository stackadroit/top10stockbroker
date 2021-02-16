<form role="search" method="get" class="search-form" action="{{ esc_url( home_url( '/' ) ) }}">
    <span class="screen-reader-text">{{ _x( 'Search for:', 'label' ) }}</span>
    <input type="search" class="search-field" placeholder="{!! esc_attr_x( 'Search &hellip;', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
  <button type="submit" class="search-submitd" style="border-radius: 0px 5px 5px 0px"><i class="fa fa-search" aria-hidden="true"></i></button> 
</form>