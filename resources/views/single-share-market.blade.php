
@extends('layouts.app-full')

@section('content')
  @include('partials.suggestion-menu')
  @while(have_posts()) @php the_post() @endphp
  	@include('partials.share-market.page-header')
    <div id="ajax-load-api-data" data-post-id="{{$post->ID}}">
      @if(has_term('gainers-losers', 'sm-category', $post))   
        <div id="sectors-id"></div>
        <div id="return-calculator-id"></div>
      @elseif(has_term('high-low', 'sm-category', $post)) 
        <div id="sectors-id"></div>
        <div id="return-calculator-id"></div>
      @else
        @include('partials.share-market.company-details')
        <div id="chart-id"></div>
        <div id="sectors-id"></div>
        <div id="return-calculator-id"></div> 
      @endif
        
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
