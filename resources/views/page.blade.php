@extends('layouts.app')

@section('content')
  @include('partials.suggestion-menu')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-page')
  @endwhile
@endsection
