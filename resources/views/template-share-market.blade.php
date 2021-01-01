{{--
  Template Name: Share Market
--}}

@extends('layouts.app-full')

@section('content')
  @include('partials.suggestion-menu')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.share-market.page-header')
    @include('partials.share-market.template-company-details')
    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}">
        <div id="chart-id"></div>
        <div id="sectors-id"></div>
        <div id="return-calculator-id"></div>
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
