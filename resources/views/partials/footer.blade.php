@include('partials.bottom-banner')
<footer id="footer" class="content-info mb-0">
  @if (!$is_mobile)
  <div class="container">
    <div class="row py-5 my-4">
      <div class="col-md-9 mb-4 mb-lg-0">
        <h5 class="text-3 mb-3">ABOUT US</h5>
        <p class="mt-2 mb-2">{{ $footer_about }}</p>
        <p><a href="/about-us" class="btn-flat btn-xs text-color-light"><strong class="text-2">VIEW MORE</strong></a></p>
        <div class="row pt-3">
          <div class="col-6 col-lg-3 mb-4 mb-lg-0">
            {{-- dynamic_sidebar('sidebar-footer') --}}
            <h5 class="text-3 mb-3">BLOGS</h5>
            {!! wp_nav_menu(['menu' =>'Blogs','menu_id' => 'priority-menu-closed','menu_class' => 'list list-icons list-icons-sm mb-0"']) !!}
          </div>
          <div class="col-6 col-lg-3 mb-4 mb-lg-0">
            <h5 class="text-3 mb-3">SUB BROKERS</h5>
           {!! wp_nav_menu(['menu' =>'Sub Brokers','menu_class' => 'list list-icons list-icons-sm mb-0"']) !!}
          </div>
          <div class="col-6 col-lg-3 mb-4 mb-lg-0">
            <h5 class="text-3 mb-3">STOCK BROKERS</h5>
            {!! wp_nav_menu(['menu' =>'Stock Brokers','menu_class' => 'list list-icons list-icons-sm mb-0"']) !!}
          </div>
          <div class="col-6 col-lg-3 mb-4 mb-lg-0">
            <h5 class="text-3 mb-3">BRANCHES</h5>
            {!! wp_nav_menu(['menu' =>'Branches','menu_id' => 'priority-menu-closed','menu_class' => 'list list-icons list-icons-sm mb-0"']) !!}
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4 mb-lg-0">
        <h5 class="text-3 mb-3 pb-1">CONTACT US</h5>
        <p class="text-2 text-color-light font-weight-bold"><a href="mailto:info@top10stockbroker.com" title="info@top10stockbroker.com">info@top10stockbroker.com</a></p>
        <ul class="footer-social-icons social-icons mt-4">
          <li class="social-icons-facebook"><a href="https://www.facebook.com/top10stockbroker/" target="_blank" title="Facebook" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a></li>
          <li class="social-icons-twitter"><a href="https://twitter.com/topstockbrokerz" target="_blank" title="Twitter" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a></li>
          <li class="social-icons-youtube"><a href="https://www.youtube.com/channel/UCaIzPe052VbL27gbXurAmjg" target="_blank" title="Youtube" rel="noopener" aria-label="Youtube"><i class="fab fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
  @endif
  <div class="footer-copyright">
    <div class="container py-2">
      <div class="row py-4">
        <div class="col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
          <p>{!! sprintf(__('&copy; Copyright %d. All Rights Reserved | Check out our <a style="color: #e35032;
    text-decoration: underline;" href="%s" >Disclaimer & Terms & Condition </a>', "stockadroit"), date("Y"), "https://top10stockbroker.com/disclaimer-terms-conditions/") !!}</p>
        </div>
        <div class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end">
          <nav id="sub-menu">
            <ul>
              <li><i class="fas fa-angle-right"></i><a href="https://top10stockbroker.com/contact-us/" class="ml-1 text-decoration-none"> Contact Us</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</footer>
<div id="custom-hellobar" class="text-center" data-toggle="modal" data-target=".popup-main" data-keyboard="false" data-backdrop="static">
  @if( !empty($hello_bar['custom_hellobar']) )
    {!! get_post_meta( $post->ID, $hello_bar['custom_hellobar'], true ) !!}
  @elseif($hello_bar['hello_bar'] == 'yes')
    <small>Get 80% Revenue Sharing Now! </small><<a href="#" onclick="return false;">Become Sub Broker</a>
  @else
    <small>Get 90% Discount on Brokerage Now! </small><a href="#" onclick="return false;">Open Demat Account</a>
  @endif
</div>
@php $hello_bar_data =  str_replace('"', "'", json_encode($hello_bar)) @endphp
<div class="modal fade popup-main" id="popup-main" tabindex="-1" role="dialog" aria-hidden="true" data-plugin-options="{{ $hello_bar_data }}" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mini-b2cpopup" id="mini-b2cpopup" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mini-b2bpopup" id="mini-b2bpopup" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mini-ipopopup" id="mini-ipopopup" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade mini-pmspopup" id="mini-pmspopup" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>          
          
          
<div class="modal fade mbf-search-popup" id="mbf-search-popup" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content model-popup">
      <button type="button" class="close" id="model-main-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="load-model">
          <div class="fb-loader loader"></div>
      </div>
    </div>
  </div>
</div>
<div id="mbf-search-wrap" data-toggle="modal" data-target="#mbf-search-popup" data-keyboard="false" data-backdrop="static"></div>
<div class="overlay"></div>
