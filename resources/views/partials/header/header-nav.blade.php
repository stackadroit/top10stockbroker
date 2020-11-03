<div class="header-nav-bar">
  <div class="container">
    <div class="header-row">
      <div class="header-column">
        <div class="header-row justify-content-end">
          <div class="header-mobile-style header-nav">
            <h2 class="logo-mobile hidden-lg hidden-md">
              <a href="#" rel="home">
                <img class="" width="132" height="44" src="https://top10stockbroker.com/wp-content/uploads/2017/11/cropped-cropped-logo-web-1.png" alt="top10stockbroker">              </a>
            </h2>
            <div class="close-menu-mobile hidden-lg hidden-md">
              <i class="fas fa-times"></i>
            </div>
            <nav class="justify-content-start main-navigation">
              @if (has_nav_menu('primary_navigation'))
                {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mega-menu']) !!}
              @endif
            </nav>
          </div>
          <button class="btn header-btn-collapse-nav">
            <i class="fas fa-bars"></i>
          </button>
          <div class="header-nav-features order-1 order-lg-2">
            <a href="#" class="header-nav-features-toggle" data-focus="headerSearch">
              <i class="fas fa-search header-nav-top-icon"></i>
            </a>
            <div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
              <form role="search" action="" method="get">
                <div class="simple-search input-group">
                  <input class="form-control text-1" id="headerSearch" name="q" type="search" value=""
                         placeholder="Search...">
                  <span class="input-group-append">
                      <button class="btn" type="submit">
                        <i class="fa fa-search header-nav-top-icon"></i>
                      </button>
                    </span>
                </div>
              </form>
              <div id="search-result-nav">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>