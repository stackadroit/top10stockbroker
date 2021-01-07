<form role="search" method="get" class="search-form" action="{{ esc_url( home_url( '/' ) ) }}">
    <span class="screen-reader-text">{{ _x( 'Search for:', 'label' ) }}</span>
    <input type="search" class="search-field" placeholder="{!! esc_attr_x( 'Search &hellip;', 'placeholder' ) !!}" value="{{ get_search_query() }}" name="s" />
  <button type="submit" class="search-submit">  {{ esc_attr_x( 'Search', 'submit button' ) }}" </button> 
</form>