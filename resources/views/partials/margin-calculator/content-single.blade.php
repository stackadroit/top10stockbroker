<article @php post_class() @endphp>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  @include('partials.margin-calculator.choose-broker')
  @include('partials.margin-calculator.main-calculator')

  @php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'wpcf-after-calculator', true)); @endphp

  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
