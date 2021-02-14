<article {!! $get_post_class !!}>
   {!! @$get_thumb !!}
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
  </div>
</article>
