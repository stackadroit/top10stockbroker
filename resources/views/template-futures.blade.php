{{--
  Template Name: Future Template
--}}
@extends('layouts.app-full')
@section('content')
  @include('partials.suggestion-menu')    
  @while(have_posts()) @php the_post()
    @endphp
    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}" data-inst-name="{{$inst_name}}" data-symbol="{{$symbol}}" data-exp-date="{{$ExpDate}}" data-opt-type="{{$OptType}}" data-stk-price="{{$StkPrice}}" data-company-name="{{$companyName}}" data-cDetails="{{$cDetails}}">
    
        <!--  <div id="chart-data-id"></div> -->
        <div id="most-active-stock-data-id"></div>
        <!-- <div id="most-active-index-data-id"></div> -->
        <!-- <div id="top-open-interest-stock-data-id"></div> -->
        <!-- <div id="top-open-interest-index-data-id"></div> -->
    </div>
    @include('partials.content-page')
  @endwhile
@endsection