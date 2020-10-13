<section class="icon-slider slider">
	@if( have_rows('quiker_data', $id ) )
		@while (have_rows('quiker_data',$id))
		@php the_row() @endphp
			<div>
		      <a href="{!! get_sub_field('title') !!}" target="_blank">
		     <img src="{{ get_sub_field('icon') }}" alt="globe">
		      <h4>{{ get_sub_field('link') }}</h4>
		      </a>
		    </div>
		@endwhile    
    @endif
</section>