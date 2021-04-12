<article {!! $get_post_class !!}>
  <div class="news-thumb">
    @php 
    if(has_post_thumbnail(get_the_ID())){
         echo get_the_post_thumbnail(get_the_ID());
    } 
    @endphp
    
 </div>
 <div class="news-content">
      <header>
        <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
         
      </header>
  	<div class="above-entry-meta">
  		<span class="cat-links">
      @php 
        $categories = get_the_category(get_the_ID());
        
        $separator = ' ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
            
        } 
       echo trim( $output, $separator );
       @endphp
  		 </span>
  	</div>
    
    <div class="entry-summary">
       {!! the_excerpt() !!}
       
      @php comments_template('/partials/comments.blade.php') @endphp
    </div>
  </div>
</article>
