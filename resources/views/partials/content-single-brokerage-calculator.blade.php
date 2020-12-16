<article @php post_class() @endphp>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  @include('partials.brokerage-calculator.choose-broker')
  @include('partials.brokerage-calculator.main-calculator')
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
