{{--
  Template Name: Option Chain Template
--}}
@extends('layouts.app-full')
@section('content')
  @include('partials.suggestion-menu')    
  @while(have_posts()) @php the_post()
    @endphp
    @if($get_detail_page)
        @if($get_detail_page['page'] =='put-call-ratio')
            @include('partials.ajax.option-chain.put-call-ratio-detail')
        @endif
        @if($get_detail_page['page'] =='most-active-stock-option' || $get_detail_page['page'] == 'most-active-index-option')
            @include('partials.ajax.option-chain.most-active-stock-index-option-detail')
        @endif
        @if($get_detail_page['page'] =='open-interest-stock-option' || $get_detail_page['page'] == 'open-interest-index-option')
            @include('partials.ajax.option-chain.top-open-interest-stock-index-option-detail')
        @endif
         
    @else
    @include('partials.option-chain.page-header')
    @include('partials.option-chain.company-details')

    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}" data-inst-name="{{$inst_name}}" data-symbol="{{$symbol}}" data-exp-date="{{$exp_date}}" data-opt-type="{{$opt_type}}" data-stk-price="{{$stk_price}}" data-section="{{$section}}">
        <!-- <div id="chart-data-id"></div> -->
        <div id="strike-price-analysis-data-id"></div>
        <!-- <div id="most-active-options-data-id"></div> -->
        <!-- <div id="open-interest-analysis-data-id"></div> -->
        <div id="top-put-call-ratio-data-id"></div>
        <div id="most-active-stock-options-data-id"></div>
        <div id="most-active-index-options-data-id"></div>
        <div id="top-open-interest-stock-options-data-id"></div>
        <div id="top-open-interest-index-options-data-id"></div>
    </div>
    @endif
    @include('partials.content-page')
  @endwhile
@endsection