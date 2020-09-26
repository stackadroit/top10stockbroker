<header id="header"  >
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
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
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
                <img alt="{{ get_bloginfo('name', 'display') }}" width="226" height="54" src="https://top10stockbroker.com/wp-content/uploads/2017/11/cropped-cropped-logo-web-1.png">
              </a>
            </div>
          </div>
        </div>
        <div class="header-column justify-content-end">
          <div class="header-row">
{{--            <aside id="custom_html-5" class="widget_text widget widget_custom_html clearfix">--}}
{{--                <img src="https://top10stockbroker.com/wp-content/uploads/2020/09/zerodha-leader.jpeg" class="open-b2cpopup">--}}
{{--            </aside>--}}
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav-bar bg-color-light-scale-1 z-index-0" >
      <div class="container">
        <div class="header-row">
          <div class="header-column">
            <div class="header-row justify-content-end">
              <div class="header-nav header-nav-stripe justify-content-start">
                <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                  <nav class="collapse">
                      @if (has_nav_menu('primary_navigation'))
                            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-pills']) !!}
                      @endif
                  </nav>
                </div>
                <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                  <i class="fas fa-bars"></i>
                </button>
              </div>
              <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                <div class="header-nav-feature header-nav-features-search d-inline-flex">
                  <a href="#" class="header-nav-features-toggle" data-focus="headerSearch"><i class="fas fa-search header-nav-top-icon"></i></a>
                  <div class="header-nav-features-dropdown " id="headerTopSearchDropdown">
                    <form role="search" action="" method="get">
                      <div class="simple-search input-group">
                        <input class="form-control text-1" id="headerSearch" name="q" type="search" value="" placeholder="Search...">
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
  </div>
</header>
{{--<header id="header">--}}
{{--	<div class="header-body">--}}
{{--		<div class="header-top">--}}
{{--			<div class="container h-100">--}}
{{--				<div class="header-row h-100">--}}
{{--					<div class="header-column justify-content-start">--}}
{{--						<div class="header-row">--}}
{{--							<nav class="header-nav-top">--}}
{{--								<ul class="nav">--}}
{{--									<li class="nav-item nav-item-anim-icon d-none d-md-block">--}}
{{--										<a class="nav-link pl-0" href="#"><i class="fas fa-angle-right"></i> About Us</a>--}}
{{--									</li>--}}
{{--									<li class="nav-item nav-item-anim-icon d-none d-md-block">--}}
{{--										<a class="nav-link" href="#"><i class="fas fa-angle-right"></i> Contact Us</a>--}}
{{--									</li>--}}
{{--								</ul>--}}
{{--							</nav>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--					<div class="header-column justify-content-end">--}}
{{--						<div class="header-row">--}}
{{--							<ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean">--}}
{{--								<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>--}}
{{--								<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>--}}
{{--								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>--}}
{{--							</ul>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--		<div class="header-container container">--}}
{{--			<div class="header-row py-2">--}}
{{--				<div class="header-column">--}}
{{--					<div class="header-row">--}}
{{--						<div class="header-logo">--}}
{{--							<a href="{{ home_url('/') }}">--}}
{{--								<img alt="{{ get_bloginfo('name', 'display') }}" width="226" height="54" src="https://top10stockbroker.com/wp-content/uploads/2017/11/cropped-cropped-logo-web-1.png">--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--				<div class="header-column justify-content-end">--}}
{{--					<div class="header-row">--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--		<div class="header-nav-bar z-index-0">--}}
{{--			<div class="container">--}}
{{--				<div class="header-row">--}}
{{--					<div class="header-column">--}}
{{--						<div class="header-row justify-content-end">--}}
{{--							<div class="header-nav header-nav-stripe justify-content-start">--}}
{{--								<div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">--}}
{{--									<nav class="collapse">--}}
{{--										@if (has_nav_menu('primary_navigation'))--}}
{{--									        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav nav-pills']) !!}--}}
{{--									    @endif--}}
{{--									</nav>--}}
{{--								</div>--}}
{{--								<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">--}}
{{--									<i class="fas fa-bars"></i>--}}
{{--								</button>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
{{--</header>--}}
