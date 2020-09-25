<header id="header">
	<div class="header-body">
		<div class="header-top">
			<div class="container h-100">
				<div class="header-row h-100">
					<div class="header-column justify-content-start">
						<div class="header-row">
							<nav class="header-nav-top">
								<ul class="nav">
									<li class="nav-item nav-item-anim-icon d-none d-md-block">
										<a class="nav-link pl-0" href="#"><i class="fas fa-angle-right"></i> About Us</a>
									</li>
									<li class="nav-item nav-item-anim-icon d-none d-md-block">
										<a class="nav-link" href="#"><i class="fas fa-angle-right"></i> Contact Us</a>
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
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
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
					</div>
				</div>
			</div>
		</div>
		<div class="header-nav-bar z-index-0">
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
