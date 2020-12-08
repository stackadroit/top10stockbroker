@extends('layouts.app-full')
@section('content')
  @while(have_posts()) @php the_post()
    @endphp
    @if($get_detail_page)
        @if($get_detail_page['page'] =='active-stock')
            @include('partials.ajax.futures.most-active-stock-detail')
        @endif
        @if($get_detail_page['page'] =='interest-stock')
            @include('partials.ajax.futures.open-interest-stock-detail')
        @endif
    @else
    @include('partials.futures.page-header')
    @include('partials.futures.company-details')

    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}" data-inst-name="{{$inst_name}}" data-symbol="{{$symbol}}" data-exp-date="{{$exp_date}}" data-opt-type="{{$opt_type}}" data-stk-price="{{$stk_price}}">
    
        <div id="chart-data-id"></div>
        <div id="most-active-stock-data-id"></div>
        <div id="most-active-index-data-id"></div>
        <div id="top-open-interest-stock-data-id"></div>
        <div id="top-open-interest-index-data-id"></div>
    </div>
    @endif
    @include('partials.content-page')
  @endwhile
@endsection