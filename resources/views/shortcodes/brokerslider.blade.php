<section class="single-item slider">
@if( have_rows('slider_fields', $id ) )
    @while( have_rows('slider_fields',$id) )
    	@php the_row() @endphp
        @if(get_sub_field('slider_type') == 'Image')
		    <div>
          <a href="{{ get_sub_field('link_url') }}" target="_blank">
	          <img src="{{ get_sub_field('image_upload') }}">
	          <h3>{{ get_sub_field('title') }}</h3>
          </a>
        </div>
        @else
            <div>
              <iframe src="{{ get_sub_field('video_url') }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               <h3>{{ get_sub_field('title') }}</h3>
            </div>
        @endif
	@endwhile
@endif
</section>