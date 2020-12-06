{{--
  Template Name: Share Price
--}}

@extends('layouts.app-full')
@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.share-price.template-page-header')
    @include('partials.share-price.template-company-details')
    <div id="ajax-load-api-data" data-post-id="{{get_the_ID()}}" data-sector="{{$sector}}" data-company-name="{{$comp_name}}" data-fincode="{{$fin_code}}" data-apiexchg="{{$api_exchg}}">
        <div id="chart-id"></div>
        <div id="return-calculator-id"></div>
    </div>
    @include('partials.content-page')
  @endwhile
@endsection
