<article {!! $get_post_class !!}>
  <div class="news-thumb">
   {!! @$get_thumb !!}
 </div>
 <div class="news-content">
  	<div class="above-entry-meta">
  		<span class="cat-links">
  		{!! @$get_category_name !!}
  		 </span>
  	</div>
    <header>
      <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
       
    </header>
    <div class="entry-summary">
       {!! the_excerpt() !!}
      {!! do_shortcode(' [socialPostShare] ') !!}
      @php comments_template('/partials/comments.blade.php') @endphp
    </div>
  </div>
</article>
