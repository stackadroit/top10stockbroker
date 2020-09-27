<header id="header">
  <div class="header-body">
    <div class="header-top">
      <div class="container h-100">
        <div class="header-row h-100">
          <div class="header-column justify-content-start">
            <div class="header-row">
              <nav class="header-nav-top">
                <ul class="nav nav-pills">
                  <li class="nav-item nav-item-anim-icon d-none d-md-block">
                    <a class="nav-link pl-0" href=""><i class="fas fa-angle-right"></i> About Us</a>
                  </li>
                  <li class="nav-item nav-item-anim-icon d-none d-md-block">
                    <a class="nav-link" href=""><i class="fas fa-angle-right"></i> Upcoming IPO</a>
                  </li>
                  <li class="nav-item nav-item-anim-icon d-none d-md-block">
                    <a class="nav-link" href=""><i class="fas fa-angle-right"></i> Contact Us</a>
                  </li>
                  <li class="nav-item nav-item-anim-icon d-none d-md-block">
                    <a class="nav-link" href=""><i class="fas fa-angle-right"></i> Income Tax Calculator</a>
                  </li>
                  <li class="nav-item nav-item-anim-icon d-none d-md-block dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                      Discount Broker <i class="fas fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Zerodha</a></li>
                      <li><a class="dropdown-item" href="#">Samco</a></li>
                      <li><a class="dropdown-item" href="#">5Paisa</a></li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
          <div class="header-column justify-content-end">
            <div class="header-row">
              <ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">
                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i
                      class="fab fa-facebook-f"></i></a></li>
                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i
                      class="fab fa-twitter"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    <div class="header-nav-bar">
      <div class="container">
        <div class="header-row">
          <div class="header-column">
            <div class="header-row justify-content-end">
              <nav class="header-nav justify-content-start">
                @if (has_nav_menu('primary_navigation'))
                  {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'mega-menu']) !!}
                @endif
              </nav>
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
