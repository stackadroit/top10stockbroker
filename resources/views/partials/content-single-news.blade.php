<article @php post_class() @endphp>
   @php
   if ( has_post_thumbnail() ) {
    the_post_thumbnail();
    }
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
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    <!-- @include('partials/entry-meta') -->
  </header>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
