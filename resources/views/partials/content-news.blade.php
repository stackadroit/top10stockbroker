<article @php post_class() @endphp>
  	@php
  	the_post_thumbnail();

  	$categories = get_the_category();
	$separator = ' ';
	$output = '';
	if ( ! empty( $categories ) ) {
	    foreach( $categories as $category ) {
	        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
	    }
	    
	}
  	@endphp
  	
  	<div class="above-entry-meta">
  		<span class="cat-links">
  		@php
  				echo trim( $output, $separator );
  		@endphp
  		 </span>
  	</div>
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
     
  </header>
  <div class="entry-summary">
    @php the_excerpt() @endphp
    {!! do_shortcode(' [socialPostShare] ') !!}
  </div>
</article>
