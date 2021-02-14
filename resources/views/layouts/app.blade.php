<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap container" id="main-content" role="document">
      <div class="content row">
        <main class="main col-lg-9 order-lg-1">
          @include('partials.ajax.widget-market')
          @yield('content')
        </main>
        @if (App\display_sidebar() && !$is_mobile)
          <aside class="sidebar col-lg-3 order-lg-2" id="site-sidebar" >
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
