<header id="header" class="">
  <div class="header-body">
    @include('partials.header.header-top')
    <div class="header-container container">
      <div class="header-row py-2">
        <div class="header-column">
          <div class="header-row">
            <div class="header-logo">
              <a href="{{ home_url('/') }}">
                <img alt="{{ get_bloginfo('name', 'display') }}" width="226" height="54"
                     src="https://top10stockbroker.com/wp-content/uploads/2017/11/cropped-cropped-logo-web-1.png">
              </a>
            </div>
          </div>
        </div>
        <div class="header-column justify-content-end">
          <div class="header-row">
          </div>
        </div>
      </div>
    </div>
    @include('partials.header.header-nav')
  </div>
</header>

