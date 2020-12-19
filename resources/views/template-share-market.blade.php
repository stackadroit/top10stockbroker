{{--
  Template Name: Share Market
--}}

@extends('layouts.app-full')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  	<!-- {{ $posts = json_encode($getposts) }} -->
    @include('partials.share-market.page-header')
    @include('partials.share-market.template-company-details')
      <div id="test-chart-id"></div>
    <div id="ajax-load-api-data">
        <div id="chart-id"></div>
        <div id="sectors-id"></div>
        <div id="return-calculator-id"></div>
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
