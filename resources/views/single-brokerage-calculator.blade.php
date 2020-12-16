@extends('layouts.app')

@section('content')
	@include('partials.suggestion-menu')
  @while(have_posts()) @php the_post() @endphp
  
    @include('partials.content-single-'.get_post_type())
    
    {!! do_shortcode(' [socialPostShare] ') !!}
  @endwhile
@endsection

