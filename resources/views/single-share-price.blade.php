@extends('layouts.app-full')
@section('content')
  @include('partials.suggestion-menu')  
  @while(have_posts()) @php the_post() @endphp
    @include('partials.share-price.page-header')
    @include('partials.share-price.company-details')

    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}" data-sector="" data-company-name="{{$comp_name}}" data-fincode="{{$fin_code}}" data-apiexchg="{{$api_exchg}}">
        <div id="chart-id"></div>
        <div id="history-price-id"></div>
        <div id="fundamental-analysis-data-id"></div>
        <div id="comparative-analysis-data-id"></div>
        <div id="peers-camparison-data-id"></div>
        <div id="dividend-data-id"></div>
        <div id="return-calculator-id"></div>
        <div id="profit-loss-id"></div>
        <div id="balence-sheet-id"></div>
        <div id="corporate-actions-id"></div>
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
