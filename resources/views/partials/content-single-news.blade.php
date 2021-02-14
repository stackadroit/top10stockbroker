<article {!! $get_post_class !!}>
  {!! @$get_thumb !!}
  <div class="above-entry-meta">
      <span class="cat-links">
        {!! @$get_category_name !!}
      </span>
    </div>
  <header>
    <h1 class="entry-title">{!! get_the_title() !!}</h1>
    <!-- @include('partials/entry-meta') -->
  </header>
  <div class="entry-content">
    {!! the_content() !!}
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'stockadroit'), 'after' => '</p></nav>']) !!}
  </footer>
   {!! comments_template('/partials/comments.blade.php') !!}
</article>
