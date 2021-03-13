<header id="header" class="">
  <div class="header-body">
    @include('partials.header.header-top')
    <div class="header-container container">
      <div class="header-row py-2 row">
        <div class="header-column col-sm-4">
          <div class="header-row">
            <div class="header-logo">
              <a href="{{ home_url('/') }}">
                <img alt="Top10StockBroker.com Logo" width="226" height="54"
                     src="https://top10stockbroker.com/wp-content/uploads/logo.png">
              </a>
            </div>
          </div>
        </div>
        <div class="header-column justify-content-end  col-sm-8">
          <div class="header-row">
            {!! do_shortcode('[LB_BANNER_DISPLAY_SHORTCODE url="'.get_the_permalink().'" type="1"]') !!}
          </div>
        </div>
      </div>
    </div>
    @include('partials.header.header-nav')
  </div>
</header>

